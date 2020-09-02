#Input 
#	"task_id": t_id=7 

import sys
t_id=sys.argv[1]

import kanboard
kb = kanboard.Client('http://192.168.100.143/kanboard/jsonrpc.php', 'jsonrpc', '392dc75baf66ae2205e9d0655a3e150c5766d011031658c7a1f3d152f5ef')

AllInternalTaskLinks=kb.getAllTaskLinks(task_id=t_id)
UpdateSwitch=0

for i in range(0,len(AllInternalTaskLinks)):
	InternalTaskLinkById=kb.getTaskLinkById(task_link_id=AllInternalTaskLinks[i]['id'])
	if InternalTaskLinkById['link_id']=='12' and InternalTaskLinkById['label']=='updatet':
		UpdateSwitch=1
		OppositeTaskToUpdate=kb.getTask(task_id=InternalTaskLinkById['opposite_task_id'])
		UpdatedTaskID=kb.duplicateTaskToProject(task_id=t_id, project_id=OppositeTaskToUpdate['project_id'], swimlane_id=OppositeTaskToUpdate['swimlane_id'], column_id=OppositeTaskToUpdate['column_id'], category_id=OppositeTaskToUpdate['category_id'], owner_id=OppositeTaskToUpdate['owner_id'])
		#CopyInternalLinks
		for j in range(0,len(AllInternalTaskLinks)):
			if j!=i:
				tmp_InternalTaskLinkById=kb.getTaskLinkById(task_link_id=AllInternalTaskLinks[j]['id'])
				if tmp_InternalTaskLinkById is not None and tmp_InternalTaskLinkById['link_id']!='12':
					kb.createTaskLink(task_id=UpdatedTaskID, opposite_task_id=tmp_InternalTaskLinkById['opposite_task_id'], link_id=tmp_InternalTaskLinkById['link_id'])
		tmp_CreatedTaskLink=kb.createTaskLink(task_id=t_id, opposite_task_id=UpdatedTaskID, link_id='12')
        	#CopyFiles
		tmp_AllTaskFiles=kb.getAllTaskFiles(task_id=t_id)
		for j in range(0,len(tmp_AllTaskFiles)):
			tmp_DownloadTaskFile=kb.downloadTaskFile(file_id=tmp_AllTaskFiles[j]['id'])
			tmp_CreatedTaskFile=kb.createTaskFile(project_id=OppositeTaskToUpdate['project_id'], task_id=UpdatedTaskID, filename=tmp_AllTaskFiles[j]['name'], blob=tmp_DownloadTaskFile)
		#RemoveOldTask
		tmp_removeTask=kb.removeTask(task_id=InternalTaskLinkById['opposite_task_id'])
if UpdateSwitch==0:
	print('Keine Karte zum Updaten (interne Verbindung: UPDATET) gefunden.')
elif UpdateSwitch==1:
	print('Alle Karten, die mit UPDATET intern verbunden sind, wurden geupdatet.')
