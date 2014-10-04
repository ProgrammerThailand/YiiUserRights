YiiUserRights
=============

Yii Framework User and Rights modules base on bootstrap 3 css framework

Requirement
=============
YiiBooster

Installing
=============
Copy user and rights folder to protected/modules

Configuration
=============
Open configuration file in protected/config/main.php and edit
Import Section Add
  'import'=>array(
    

		'application.modules.user.models.*',
		'application.modules.user.components.*',
		'application.modules.rights.*',
		'application.modules.rights.components.*',
	),
Modules Section Add
	'modules'=>array(
		// uncomment the following to enable the Gii tool


		'user'=>array(
			'tableUsers'=>'users',
			'tableProfiles'=>'profiles',
			'tableProfileFields'=>'profiles_fields',
		),
		'rights'=>array(
			'install'=>false,
		)

	),
	
Components Section Add
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class'=>'RWebUser',
			'loginUrl'=>array('/user/login'),
		),
		'authManager'=>array(
			'class'=>'RDbAuthManager',
			'connectionID'=>'db',
			'defaultRoles'=>array('Authenticated','Guest'),
			'assignmentTable'=>'authassignment',
			'itemChildTable'=>'authitemchild',
			'itemTable'=>'authitem',
			'rightsTable'=>'rights',
		),
	),

	
