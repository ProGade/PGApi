<?php
/*
* ProGade API
* Copyright (c) 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Jun 27 2014
*/
mt_srand((double)microtime()*1000000);

define('PG_LOGIN_USERTYPE_GUEST', 0);
define('PG_LOGIN_USERTYPE_USER', 1);
define('PG_LOGIN_USERTYPE_MODERATOR', 2);
define('PG_LOGIN_USERTYPE_ADMIN', 4);
define('PG_LOGIN_USERTYPE_SUPERADMIN', 8);

define('PG_LOGIN_BUILD_TYPE_LOGIN_NORMAL', 0);
define('PG_LOGIN_BUILD_TYPE_LOGIN_BAR_TOP', 1);
define('PG_LOGIN_BUILD_TYPE_LOGIN_BAR_BOTTOM', 2);
define('PG_LOGIN_BUILD_TYPE_ACCOUNT_REGISTER', 3);
define('PG_LOGIN_BUILD_TYPE_ACCOUNT_EDIT', 4);
define('PG_LOGIN_BUILD_TYPE_ACCOUNT_RESET_PASSWORD', 5);
define('PG_LOGIN_BUILD_TYPE_ACCOUNT_ACCEPT', 6);

define('PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_SERIAL', 'serial');
define('PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_SIMPLE', 'simple');
define('PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_STRONG', 'strong');

/*
@start class

@var LoginDataDefines
PG_LOGIN_GLOBAL_URL_PATH
PG_LOGIN_PASSWORD_RESET_ACCEPT_FILE_PATH
PG_LOGIN_ACCOUNT_ACCEPT_FILE_PATH
PG_LOGIN_SYSTEM_EMAIL
PG_LOGIN_SYSTEM_TITLE

PG_LOGIN_DATABASE_HOST
PG_LOGIN_DATABASE_USER
PG_LOGIN_DATABASE_PASSWORD
PG_LOGIN_DATABASE_DATABASE
PG_LOGIN_DATABASE_TABLE_PREFIX

PG_LOGIN_MYSQL_HOST
PG_LOGIN_MYSQL_USER
PG_LOGIN_MYSQL_PASSWORD
PG_LOGIN_MYSQL_DATABASE
PG_LOGIN_MYSQL_TABLE_PREFIX

PG_LOGIN_MSSQL_HOST
PG_LOGIN_MSSQL_USER
PG_LOGIN_MSSQL_PASSWORD
PG_LOGIN_MSSQL_DATABASE
PG_LOGIN_MSSQL_TABLE_PREFIX

PG_LOGIN_SECRET_KEY_1
PG_LOGIN_SECRET_KEY_2
PG_LOGIN_SECRET_KEY_3
PG_LOGIN_SECRET_KEY_4
PG_LOGIN_SECRET_KEY_5

PG_LOGIN_COOKIE_NAME
PG_LOGIN_COOKIE_TIME
PG_LOGIN_COOKIE_PATH
PG_LOGIN_COOKIE_DOMAIN
PG_LOGIN_COOKIE_SECURE

@description
[en]
	This class has methods to authenticate users and their general user status.
	If any of the following defines were set, this class uses the data automatically:
	%LoginDataDefines%
[/en]
[de]
	Diese Klasse verfügt über Methoden zur Authentifizierung von Benutzern und dessen allgemeiner Benutzerstatus.
	Wenn eines der folgenden Defines gesetzt wurden, verwendet diese Klasse die Daten automatisch:
	%LoginDataDefines%
[/de]

@param extends classPG_ClassBasics

@var LoginUserTypes
PG_LOGIN_USERTYPE_GUEST
PG_LOGIN_USERTYPE_USER
PG_LOGIN_USERTYPE_MODERATOR
PG_LOGIN_USERTYPE_ADMIN
PG_LOGIN_USERTYPE_SUPERADMIN
*/
class classPG_Login extends classPG_ClassBasics
{
	// Declarations...
	private $iUserType = PG_LOGIN_USERTYPE_GUEST;
    private $iDefaultUserType = PG_LOGIN_USERTYPE_USER;
    private $iDefaultBuildType = PG_LOGIN_BUILD_TYPE_LOGIN_NORMAL;
	private $axLoginData = array();
	private $bLoginFailed = false;
    private $bLoginSuccess = false;
    private $bLogoutSuccess = false;
	private $bActionLog = false;
	private $bMultiLogin = false;
    private $bUsernameInPasswordCryption = true;
    private $bAccountNotAccepted = false;
	
	private $sFormCharset = 'ISO-8859-1'; // UTF-8
	
	private $bAllowRegister = false;
	private $bAllowPasswordReset = false;
	private $bAllowChangeUsername = false;
	private $bAllowChangeEmail = false;
	
	private $bAutoGeneratePassword = false;
	private $bDisplayPassword = false;
	
	private $bAccountFormUserMinCountError = false;
	private $bAccountFormPasswordMinCountError = false;
	private $bAccountFormEmailSyntaxCheckOk = false;
	private $bAccountFormUserExistsError = false;
	private $bAccountFormEmailExistsError = false;
	private $bAccountFormCaptchaOk = false;	
	
	private $bAccountFormAcceptedPrivacyPolicy = false;
	private $bAccountFormAcceptedPrivacyTerms = false;
	private $bAccountFormAcceptedTermsOfUse = false;
	private $bAccountFormAcceptedTermsAndConditions = false;
	
	private $iMinCharCountUsername = 5;
	private $iMinCharCountPassword = 6;
	
	private $bWasSessionUsed = false;
	// private $bSessionsStarted = false;
    private $bSessionAutoOpen = false;
    private $bSessionAutoClose = false;

	private $bRegisterWithCaptcha = false;
	private $bLoginWithCaptcha = false;

    private $bUseRegisterButton = false;
	
	private $bRequireUsername = true;
	private $bRequireEmail = true;
	
	private $bEmailAsUsername = false;
	
	private $sLoginGlobalUrl = '';
	private $sPasswordResetAcceptFilePath = 'index.php';
	private $sAccountAcceptFilePath = '';
	private $sSystemEmail = '';
	private $sSystemTitle = '';
	
	private $bSendAcceptRequestEmail = true;
	private $bSendAcceptSuccessEmail = true;
	// private $bSendAcceptFailedEmail = true;
	private $bSendRegisterFailedEmail = false;
	
	private $sMailAcceptSubject = '';
	private $sMailAcceptMessage = '';
	private $bMailAcceptToSystemEmail = false;
	private $sMailAcceptToEmails = '';
	
	private $sMailAcceptSuccessSubject = '';
	private $sMailAcceptSuccessMessage = '';
	private $bMailAcceptSuccessToSystemEmail = false;
	private $sMailAcceptSuccessToEmails = '';

	/*
	private $sMailAcceptFailedSubject = '';
	private $sMailAcceptFailedMessage = '';
	private $bMailAcceptFailedToSystemEmail = false;
	private $sMailAcceptFailedToEmails = '';
	*/
	
	private $sMailRegisterFailedSubject = '';
	private $sMailRegisterFailedMessage = '';
	private $bMailRegisterFailedToSystemEmail = false;
	private $sMailRegisterFailedToEmails = '';

    private $xDefaultMailTemplate = NULL;
    private $xRegisterMailTemplate = NULL;
    private $xRegisterSuccessMailTemplate = NULL;
    private $xRegisterFailedMailTemplate = NULL;
    private $xPasswordResetMailTemplate = NULL;

    private $sMailPasswordResetSubject = '';
	private $sMailPasswordResetMessage = '';
	
	private $sPrivacyPolicyUrl = '';
	private $sPrivacyTermsUrl = '';
	private $sTermsOfUseUrl = '';
	private $sTermsAndConditionsUrl = '';
	
	private $sSecretKey1 = 'TB!g98ha';
	private $sSecretKey2 = '49Gv?zWy';
	private $sSecretKey3 = 'ui$ajPBL';
	private $sSecretKey4 = 'kJG!56F';
	private $sSecretKey5 = 'h32!jK3n';

	private $sAdditionalSelect = '';
    private $asFieldsOnRegister = array('sFirstName', 'sLastName', 'sStreet', 'sZipCode', 'sLocation', 'sCountry');
	private $asRequired = array('sUsername', 'sEmail');
	private $asRequiredFailed = array();

    private $bAccountFormRequireEmailRetype = false;
    private $bAccountFormRequirePasswordRetype = false;
	
	private $iLoginFailedMinWaittime = 5;
	private $iLoginFailedMaxWaittime = 3;
	private $iLoginRelogWaittime = 1;

	private $sCookieName = 'PGCookie';
	private $iCookieTime = 0;
	private $sCookiePath = '/';
	private $sCookieDomain = '';
	private $bCookieSecure = false;
    private $bCookieSessions = true;

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGLogin'));
		$this->initClassBasics();
		$this->initDatabase();
        $this->initTemplate();
		$this->setText(
			array('xType' => 
				array(
                    'RewriteUrlRegister' => './',
                    'RewriteUrlProfile' => './',
                    'RewriteUrlLogin' => './',
                    'RewriteUrlLogout' => './',
                    'RewriteUrlPasswordReset' => './',

					'Username' => 'Benutzername',
					'FirstName' => 'Vorname',
					'LastName' => 'Nachname',
				
					'LoggedInMessage' => 'Eingeloggt als [Username] (<a href="index.php?iPGLogout=1" target="_self">log out</a>)',
					'LoginErrorsMessage' => 'Login fehlgeschlagen! Ihr Benutzername oder Passwort wurde nicht gefunden.<br />',
                    'LoginNotAcceptedErrorMessage' => 'Sie haben Ihren Account noch nicht &uuml;ber Ihre E-Mail-Adresse best&auml;tigt. <a href="index.php?resend_accept_mail=true&email=[email]" target="_self">E-Mail erneut zusenden</a>.',
					'NoDataUsername' => 'Benutzername',
					'NoDataPassword' => '***',
					'ButtonLogin' => 'log in',
					'ButtonRegister' => 'registrieren',

					'NoAccountQuestion' => 'Sie haben noch keine Zugangsdaten?<br />Dann k&ouml;nnen Sie sich <a href="index.php?sPGAccount=register" target="_self">hier registrieren</a>.',
					'ForgotYourPasswordQuestion' => 'Haben Sie Ihr Passwort vergessen?<br />Dann k&ouml;nnen Sie Ihr<br /><a href="index.php?sPGAccount=password_reset" target="_self">Passwort hier zur&uuml;cksetzen lassen</a>.',
					
					'CaptchaFailed' => 'Der Sicherheitscode stimmt nicht mit Ihrer Eingabe &uuml;berein!',
					
					'AccountChangeFailed' => 'Das Speichern der &Auml;nderungen ist fehlgeschlagen!',

					'ConfimationEmailHasBeenSent' => 'Ihnen wurde eine E-Mail zum Best&auml;tigen gesendet.',

                    'AccountFormButtonRegisterText' => 'Registrieren',
                    'AccountFormButtonEditText' => 'Bearbeiten',
					
					'AccountFormUserExistsError' => 'Es existiert bereits ein Account mit Benutzername "[username]"!',
					'AccountFormEmailExistsError' => 'Es existiert bereits ein Account mit der E-Mail-Adresse "[email]"!',
					'AccountFormEmailMatchError' => 'Die E-Mail-Adresse stimmt nicht mit der wiederholten Eingabe &uuml;berein! (Eingabe: "[email]" und "[email_retype]")',
					'AccountFormPasswordMatchError' => 'Das Passwort stimmt nicht mit der wiederholten Eingabe &uuml;berein!',
					
					'AcceptPrivacyPolicy' => 'Ich habe die <a href="%sPrivacyPolicyUrl%" target="_blank">Datenschutzerkl&auml;rung</a> gelesen und akzeptiere diese.',
					'AcceptPrivacyPolicyFailed' => 'Sie m&uuml;ssen die Datenschutzerkl&auml;rung akzeptieren um einen Account zu ersetllen!',
					'AcceptPrivacyTerms' => 'Ich habe die <a href="%sPrivacyTermsUrl%" target="_blank">Datenschutzrichtlinien</a> gelesen und akzeptiere diese.',
					'AcceptPrivacyTermsFailed' => 'Sie m&uuml;ssen die Datenschutzrichtlinien akzeptieren um einen Account zu erstellen!',
					'AcceptTermsOfUse' => 'Ich habe die <a href="%sTermsOfUseUrl%" target="_blank">Nutzungsbedingungen</a> gelesen und akzeptiere diese.',
					'AcceptTermsOfUseFailed' => 'Sie m&uuml;ssen die Nutzungsbedingungen akzeptieren um einen Account zu erstellen!',
					'AcceptTermsAndConditions' => 'Ich habe die <a href="%sTermsAndConditionsUrl%" target="_blank">AGB</a> gelesen und akzeptiere diese.',
					'AcceptTermsAndConditionsFailed' => 'Sie m&uuml;ssen die AGB akzeptieren um einen Account zu erstellen!',

					'AccountRegisterSuccess' => 'Ihre Registierung war erfolgreich.',
					'AccountRegisterFailed' => 'Das Speichern Ihrer Registrierung ist fehlgeschlagen!',
					'AccountRegisterWaitForAdminAccept' => 'Ihre Registrierung wird von einem Admin gebr&uuml;ft und danach freigeschaltet.',
					
					'AccountAcceptSuccess' => 'Ihr Account wurde best&auml;tigt und kann ab sofort verwendet werden.',
					'AccountAcceptFailed' => 'Ihr Account konnte nicht best&auml;tigt werden! Bitte versuchen Sie es sp&auml;ter noch einmal.',
					'AccountAcceptSecureCodeFailed' => 'Der Sicherheitscode passt nicht zur E-Mail-Adresse!',
					'AccountAcceptEmailNotFound' => 'Ihre E-Mail-Adresse wurde nicht in unserer Datenbank gefunden!',
					'AccountAcceptParametersFailed' => 'Es wurden keine Parameter &uuml;bergeben!',

					'PasswordResetTempUpdateSuccess' => 'Die Anfrage zum Zur&uuml;cksetzen Ihres Passworts war erfolgreich.',
					'PasswordResetTempUpdateFailed' => 'Die Anfrage zum Zur&uuml;cksetzen Ihres Passworts ist fehlgeschlagen! Bitte versuchen Sie es sp&auml;ter erneut.',
					'PasswordResetUpdatePasswordSuccess' => 'Ihr Passwort wurde zur&uuml;ckgesetzt.',
					'PasswordResetUpdatePasswordWaitForAdminAccept' => 'Das Zur&uuml;cksetzen wird von einem Admin gepr&uuml;ft und danach akzeptiert.',
					'PasswordResetUpdatePasswordFailed' => 'Ihr Passwort konnte nicht zur&uuml;ckgesetzt werden! Bitte versuchen Sie es sp&auml;ter noch einmal.',
					'PasswordResetSecureCodeFailed' => 'Der Sicherheitscode passt nicht zur E-Mail-Adresse!',
					'PasswordResetEmailNotFound' => 'Ihre E-Mail-Adresse wurde nicht in unserer Datenbank gefunden!',
					'PasswordResetParametersFailed' => 'Es wurden keine Parameter &uuml;bergeben!'
				)
			)
		);
	}
	
	// Methods...
	/*
	@start method
	
	@group Update
	
	@description
	[en]Builds the update and installation structure for the tables of the database and returns it.[/en]
	[de]Erstellt die Update- und Installationsstruktur für die Tabellen der Datenbank und gibt es zurück.[/de]
	
	@return axDBChunkStructure [type]mixed[][/type]
	[en]Returns the update structure as a mixed array.[/en]
	[de]Gibt die Updatestruktur als Mixed-Array zurück.[/de]
	
	@param oDatabaseUpdate [needed][type]object[/type]
	[en]The database update object, the update structure is to be expanded.[/en]
	[de]Das Datenbank-Update-Objekt, dessen Updatestruktur erweitert werden soll.[/de]
	*/
	public function buildDatabaseUpdate($_oDatabaseUpdate)
	{
		$_oDatabaseUpdate = $this->getRealParameter(array('oParameters' => $_oDatabaseUpdate, 'sName' => 'oDatabaseUpdate', 'xParameter' => $_oDatabaseUpdate));
		
		$_axDBChunkStructures = $_oDatabaseUpdate->getDBChunkStructures();
		$_axTablesStructure = array();
		
		// user...
		$_axAddColumnStructures = array();
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UserID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => NULL, 'sOptions' => 'AUTO_INCREMENT PRIMARY KEY'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'SimulateUserID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UserType', 'sType' => 'INT', 'iSize' => 2, 'xDefault' => PG_LOGIN_USERTYPE_USER, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Title', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => NULL));
        $_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Gender', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => 'male', 'sOptions' => NULL));
        $_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'BirthDate', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'FirstName', 'sType' => 'VARCHAR', 'iSize' => 128, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'LastName', 'sType' => 'VARCHAR', 'iSize' => 128, 'xDefault' => '', 'sOptions' => NULL));
        $_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Company', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Street', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ZipCode', 'sType' => 'VARCHAR', 'iSize' => 8, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Locale', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Country', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Username', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Email', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Password', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'PwdReset', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ReloginPassword', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Access', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Language', 'sType' => 'CHAR', 'iSize' => 2, 'xDefault' => 'EN', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Accepted', 'sType' => 'INT', 'iSize' => 1, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Banned', 'sType' => 'INT', 'iSize' => 1, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
        $_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'IsCompany', 'sType' => 'INT', 'iSize' => 1, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'LoginTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ChangeTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'CreateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		
		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'user', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL,	'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));
		
		// username_disallowed...
		$_axAddColumnStructures = array();
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'DisallowedID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => NULL, 'sOptions' => 'AUTO_INCREMENT PRIMARY KEY'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Username', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ChangeTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'CreateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		
		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'username_disallowed', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL, 'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));
		
		// user_actionlog...
		$_axAddColumnStructures = array();
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'TimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UserID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ClientIP', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ServerIP', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Domain', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Port', 'sType' => 'VARCHAR', 'iSize' => 8, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'BrowserInfo', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'FileName', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UrlParameters', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ProviderInfo', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Action', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Status', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		
		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'user_actionlog', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL, 'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));
		
		// user_addresses...
		$_axAddColumnStructures = array();
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'AdressID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => NULL, 'sOptions' => 'AUTO_INCREMENT PRIMARY KEY'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UserID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
        $_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Company', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Street', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ZipCode', 'sType' => 'VARCHAR', 'iSize' => 8, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Location', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Country', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Phone', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'MobilePhone', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Fax', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => NULL));
        $_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'IsCompany', 'sType' => 'INT', 'iSize' => 1, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));

		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'user_addresses', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL, 'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));
		
		return $_oDatabaseUpdate->buildDBChunkStructure(array('sDBChunk' => 'User', 'axDBChunkStructures' => $_axDBChunkStructures, 'axTablesStructure' => $_axTablesStructure));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Update
	
	@description
	[en]Builds the update and installation for the tables in the database and returns the update object.[/en]
	[de]Erstellt das Update und Installation für die Tabellen der Datenbank und gibt das Update-Objekt zurück.[/de]
	
	@return oUpdate [type]object[/type]
	[en]Returns the updated object, which was expanded by the tables of the login.[/en]
	[de]Gibt das Update-Objekt zurück, welches um die Tabellen des Logins erweitert wurde.[/de]
	
	@param oUpdate [needed][type]object[/type]
	[en]Update object, which should be expanded.[/en]
	[de]Das Update-Objekt, welches erweitert werden soll.[/de]
	*/
	public function buildUpdate($_oUpdate)
	{
		$_oUpdate = $this->getRealParameter(array('oParameters' => $_oUpdate, 'sName' => 'oUpdate', 'xParameter' => $_oUpdate));
		
		$_oDatabaseUpdate = $_oUpdate->getDatabaseUpdate();
		$_axDBChunkStructures = $this->buildDatabaseUpdate(array('oDatabaseUpdate' => $_oDatabaseUpdate));
		$_oDatabaseUpdate->setDBChunkStructures(array('axStructure' => $_axDBChunkStructures));
		$_oUpdate->setDatabaseUpdate(array('oDatabaseUpdate' => $_oDatabaseUpdate));
		
		// $_oUpdate->setFolderUpdate(array('oFolderUpdate' => $this->buildFolderUpdate(array('oFolderUpdate' => $_oUpdate->getFolderUpdate()))));
		
		return $_oUpdate;
	}
	/* @end method */

    /*
    @start method

    @param iBuildType [needed][type]int[/type]
    [en]...[/en]
    */
    public function setDefaultBuildType($_iBuildType)
    {
        $_iBuildType = $this->getRealParameter(array('oParameters' => $_iBuildType, 'sName' => 'iBuildType', 'xParameter' => $_iBuildType));
        $this->iDefaultBuildType = $_iBuildType;
    }
    /* @end method */

    /*
    @start method

    @param xTemplate [needed][type]mixed[/type]
    [en]...[/en]
    */
    public function setDefaultMailTemplate($_xTemplate)
    {
        $_xTemplate = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));
        $this->xDefaultMailTemplate = $_xTemplate;
    }
    /* @end method */

    /*
    @start method

    @param xTemplate [needed][type]mixed[/type]
    [en]...[/en]
    */
    public function setRegisterMailTemplate($_xTemplate)
    {
        $_xTemplate = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));
        $this->xRegisterMailTemplate = $_xTemplate;
    }
    /* @end method */

    /*
    @start method

    @param xTemplate [needed][type]mixed[/type]
    [en]...[/en]
    */
    public function setRegisterSuccessMailTemplate($_xTemplate)
    {
        $_xTemplate = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));
        $this->xRegisterSuccessMailTemplate = $_xTemplate;
    }
    /* @end method */

    /*
    @start method

    @param xTemplate [needed][type]mixed[/type]
    [en]...[/en]
    */
    public function setRegisterFailedMailTemplate($_xTemplate)
    {
        $_xTemplate = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));
        $this->xRegisterFailedMailTemplate = $_xTemplate;
    }
    /* @end method */

    /*
    @start method

    @param xTemplate [needed][type]mixed[/type]
    [en]...[/en]
    */
    public function setPasswordResetMailTemplate($_xTemplate)
    {
        $_xTemplate = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));
        $this->xPasswordResetMailTemplate = $_xTemplate;
    }
    /* @end method */

    /*
    @start method

    @param asFields [needed][type]string[][/type]
    [en]...[/en]
    */
    public function setFieldsOnRegister($_asFields)
    {
        $_asFields = $this->getRealParameter(array('oParameters' => $_asFields, 'sName' => 'asFields', 'xParameter' => $_asFields));
        $this->asFieldsOnRegister = $_asFields;
    }
    /* @end method */

    /*
    @start method

    @param bUse [needed][type]bool[/type]
    [en]...[/en]
    */
    public function useRegisterButton($_bUse)
    {
        $_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
        $this->bUseRegisterButton = $_bUse;
    }
    /* @end method */

    /*
    @start method

    @param bUse [needed][type]bool[/type]
    [en]...[/en]
    */
    public function useAccountFormEmailRetype($_bUse)
    {
        $_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
        $this->bAccountFormRequireEmailRetype = $_bUse;
    }
    /* @end method */

    /*
    @start method

    @param bUse [needed][type]bool[/type]
    [en]...[/en]
    */
    public function useAccountFormPasswordRetype($_bUse)
    {
        $_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
        $this->bAccountFormRequirePasswordRetype = $_bUse;
    }
    /* @end method */

    /*
    @start method

    @description
    [en]...[/en]

    @param bUse [needed][type]bool[/type]
    [en]...[/en]
    */
    public function useUsernameInPasswordCryption($_bUse)
    {
        $_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
        $this->bUsernameInPasswordCryption = $_bUse;
    }
    /* @end method */

    /*
    @start method

    @description
    [en]...[/en]

    @param iUserType [needed][type]int[/type]
    [en]...[/en]
    */
    public function setDefaultUserType($_iUserType)
    {
        $_iUserType = $this->getRealParameter(array('oParameters' => $_iUserType, 'sName' => 'iUserType', 'xParameter' => $_iUserType));
        $this->iDefaultUserType = $_iUserType;
    }
	/* @end method */

	/*
	@start method
	
	@param sCharset [needed][type]string[/type]
	[en][/en]
	[de][/de]
	*/
	public function setFormCharset($_sCharset)
	{
		$_sCharset = $this->getRealParameter(array('oParameters' => $_sCharset, 'sName' => 'sCharset', 'xParameter' => $_sCharset));
		$this->sFormCharset = $_sCharset;
	}
	/* @end method */

    /*
    @start method

    @param bUse [needed][type]bool[/type]
    [en]...[/en]
    */
    public function useSessionAutoOpen($_bUse)
    {
        $_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
        $this->bSessionAutoOpen = $_bUse;
    }
	/* @end method */

    /*
    @start method

    @param bUse [needed][type]bool[/type]
    [en]...[/en]
    */
    public function useSessionAutoClose($_bUse)
    {
        $_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
        $this->bSessionAutoClose = $_bUse;
    }
    /* @end method */

	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Returns whether a session was used for the login.[/en]
	[de]Gibt zurück, ob eine Session für den Login verwendet wurde.[/de]
	
	@return bSessionUsed [type]bool[/type]
	[en]Returns a boolean whether a session was used for the login.[/en]
	[de]Gibt einen Boolean zurück, ob eine Session für den Login verwendet wurde.[/de]
	*/
	public function wasSessionUsed() {return $this->bWasSessionUsed;}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Sets the first secret key.[/en]
	[de]Setzt den ersten Geheimschlüssel.[/de]
	
	@param sKey [needed][type]string[/type]
	[en]The secret key as a string.[/en]
	[de]Der Geheimschlüssel als String.[/de]
	*/
	public function setSecretKey1($_sKey)
	{
		$_sKey = $this->getRealParameter(array('oParameters' => $_sKey, 'sName' => 'sKey', 'xParameter' => $_sKey));
		$this->sSecretKey1 = $_sKey;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Sets the second secret key.[/en]
	[de]Setzt den zweite Geheimschlüssel.[/de]
	
	@param sKey [needed][type]string[/type]
	[en]The secret key as a string.[/en]
	[de]Der Geheimschlüssel als String.[/de]
	*/
	public function setSecretKey2($_sKey)
	{
		$_sKey = $this->getRealParameter(array('oParameters' => $_sKey, 'sName' => 'sKey', 'xParameter' => $_sKey));
		$this->sSecretKey2 = $_sKey;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Sets the third secret key.[/en]
	[de]Setzt den dritte Geheimschlüssel.[/de]
	
	@param sKey [needed][type]string[/type]
	[en]The secret key as a string.[/en]
	[de]Der Geheimschlüssel als String.[/de]
	*/
	public function setSecretKey3($_sKey)
	{
		$_sKey = $this->getRealParameter(array('oParameters' => $_sKey, 'sName' => 'sKey', 'xParameter' => $_sKey));
		$this->sSecretKey3 = $_sKey;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Sets the fourth secret key.[/en]
	[de]Setzt den vierte Geheimschlüssel.[/de]
	
	@param sKey [needed][type]string[/type]
	[en]The secret key as a string.[/en]
	[de]Der Geheimschlüssel als String.[/de]
	*/
	public function setSecretKey4($_sKey)
	{
		$_sKey = $this->getRealParameter(array('oParameters' => $_sKey, 'sName' => 'sKey', 'xParameter' => $_sKey));
		$this->sSecretKey4 = $_sKey;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Sets the fifth secret key.[/en]
	[de]Setzt den fünfte Geheimschlüssel.[/de]
	
	@param sKey [needed][type]string[/type]
	[en]The secret key as a string.[/en]
	[de]Der Geheimschlüssel als String.[/de]
	*/
	public function setSecretKey5($_sKey)
	{
		$_sKey = $this->getRealParameter(array('oParameters' => $_sKey, 'sName' => 'sKey', 'xParameter' => $_sKey));
		$this->sSecretKey5 = $_sKey;
	}
	/* @end method */

	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Sets the name for the cookie that should be created.[/en]
	[de]Setzt den Namen für das Cookie, das angelegt werden soll.[/de]
	
	@param sName [needed][type]string[/type]
	[en]The name of the cookie as a string.[/en]
	[de]Der Name des Cookies als String.[/de]
	*/
	public function setCookieName($_sName)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$this->sCookieName = $_sName;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Returns the name of the cookie.[/en]
	[de]Gibt den Namen des Cookies zurück.[/de]
	
	@return sCookieName [type]string[/type]
	[en]Returns the name of the cookie as a string.[/en]
	[de]Gibt den Namen des Cookies als String zurück.[/de]
	*/
	public function getCookieName() {return $this->sCookieName;}
	/* @end method */
	
	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Sets a UNIX timestamp for the lifetime of the cookie.[/en]
	[de]Setzt einen Unix-Zeitstempel für die Lebensdauer des Cookies.[/de]
	
	@param iTimeStamp [needed][type]int[/type]
	[en]The timestamp as an integer.[/en]
	[de]Der Zeitstempel als Integer.[/de]
	*/
	public function setCookieTime($_iSeconds)
	{
        $_iSeconds = $this->getRealParameter(array('oParameters' => $_iSeconds, 'sName' => 'iSeconds', 'xParameter' => $_iSeconds));
		$this->iCookieTime = $_iSeconds;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Returns the UNIX timestamp for the lifetime of the cookie.[/en]
	[de]Gibt den Unix-Zeitstempel für die Lebensdauer des Cookies zurück.[/de]
	
	@return iCookieTime [type]int[/type]
	[en]Returns the UNIX timestamp for the lifetime of the cookie as an integer.[/en]
	[de]Gibt den Unix-Zeitstempel für die Lebensdauer des Cookies als Integer zurück.[/de]
	*/
	public function getCookieTime() {return $this->iCookieTime;}
	/* @end method */
	
	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Sets the path for any subfolder from which the cookie should work only.[/en]
	[de]Setzt den Pfad für eventuelle Unterordner ab denen das Cookie erst wirken soll.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The path as a string.[/en]
	[de]Der Pfad als String.[/de]
	*/
	public function setCookiePath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sCookiePath = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Returns the path from which the cookie should work.[/en]
	[de]Gibt den Pfad zurück, ab dem das Cookie wirken soll.[/de]
	
	@return sCookiePath [type]string[/type]
	[en]Returns the path as a string.[/en]
	[de]Gibt den Pfad als String zurück.[/de]
	*/
	public function getCookiePath() {return $this->sCookiePath;}
	/* @end method */
	
	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Sets the domain to which the cookie applies.[/en]
	[de]Setzt die Domain für die das Cookie gelten soll.[/de]
	
	@param sDomain [needed][type]string[/type]
	[en]The domain of the cookie. To get all subdomains working, the domain should be given without the subdomain, such as ".example.de".[/en]
	[de]Die Domain für das Cookie. Sollen alle Subdomains funktionieren, sollte die Domain ohne Subdomain angegeben werden, wie z.B. ".example.de".[/de]
	*/
	public function setCookieDomain($_sDomain)
	{
		$_sDomain = $this->getRealParameter(array('oParameters' => $_sDomain, 'sName' => 'sDomain', 'xParameter' => $_sDomain));
		$this->sCookieDomain = $_sDomain;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Returns the domain to which the cookie applies.[/en]
	[de]Gibt die Domain zurück für die das Cookie gelten soll.[/de]
	
	@return sCookieDomain [type]string[/type]
	[en]Returns the domain as a string to which the cookie applies.[/en]
	[de]Gibt die Domain als String zurück für die das Cookie gelten soll.[/de]
	*/
	public function getCookieDomain() {return $this->sCookieDomain;}
	/* @end method */
	
	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Sets the status of whether the cookie should only be set on secure connections (SSL).[/en]
	[de]Setzt den Status ob das Cookie nur bei sicheren Verbindungen (SSL) gesetzt werden soll.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether the cookie should only be set for secure connections (true) or for all connections (false).[/en]
	[de]Gibt an ob das Cookie nur bei sicheren Verbindungen (true) oder bei allen Verbindungen (false) gesetzt werden soll.[/de]
	*/
	public function useCookieSecure($_bUse)
	{
        $_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bCookieSecure = $_bUse;
	}
	/* @end method */

    /*
	@start method
	
	@group Cookies
	
	@description
	[en]Returns whether the cookie should only be set on secure connections.[/en]
	[de]Gibt zurück, ob das Cookie nur bei sicheren Verbindungen gesetzt werden soll.[/de]
	
	@return bCookieSecure [type]bool[/type]
	[en]Returns an integer whether the cookie should only be set on secure connections.[/en]
	[de]Gibt einen Integer zurück, ob das Cookie nur bei sicheren Verbindungen gesetzt werden soll.[/de]
	*/
	public function isCookieSecure() {return $this->bCookieSecure;}
	/* @end method */

    /*
    @start method

    @param bUse [needed][type]bool[/type]
    [en]...[/en]
    */
    public function useCookieSessions($_bUse)
    {
        $_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
        $this->bCookieSessions = $_bUse;
    }
    /* @end method */
	
	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Sets data for the cookie.[/en]
	[de]Setzt Daten für das Cookie.[/de]
	
	@param sName [type]string[/type]
	[en]The name of the cookie.[/en]
	[de]Der Name des Cookies.[/de]
	
	@param iTimeStamp [type]int[/type]
	[en]The timestamp as an integer.[/en]
	[de]Der Zeitstempel als Integer.[/de]
	
	@param sPath [type]string[/type]
	[en]The path as a string.[/en]
	[de]Der Pfad als String.[/de]
	
	@param sDomain [type]string[/type]
	[en]The domain of the cookie. To get all subdomains working, the domain should be given without the subdomain, such as ".example.de".[/en]
	[de]Die Domain für das Cookie. Sollen alle Subdomains funktionieren, sollte die Domain ohne Subdomain angegeben werden, wie z.B. ".example.de".[/de]
	
	@param iSecure [type]int[/type]
	[en]Specifies whether the cookie should only be set for secure connections (1) or for all connections (2).[/en]
	[de]Gibt an ob das Cookie nur bei sicheren Verbindungen (1) oder bei allen Verbindungen (2) gesetzt werden soll.[/de]
	*/
	public function setCookieData($_sName, $_iTimeStamp = NULL, $_sPath = NULL, $_sDomain = NULL, $_bSecure = NULL)
	{
		$_iTimeStamp = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'iTimeStamp', 'xParameter' => $_iTimeStamp));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$_sDomain = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sDomain', 'xParameter' => $_sDomain));
		$_bSecure = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'bSecure', 'xParameter' => $_bSecure));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));

		if ($_sName !== NULL) {$this->sCookieName = $_sName;}
		if ($_iTimeStamp !== NULL) {$this->iCookieTime = $_iTimeStamp;}
		if ($_sPath !== NULL) {$this->sCookiePath = $_sPath;}
		if ($_sDomain !== NULL) {$this->sCookieDomain = $_sDomain;}
		if ($_bSecure !== NULL) {$this->bCookieSecure = $_bSecure;}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Enables the captcha code input at registration.[/en]
	[de]Aktiviert die Captcha-Codeeingabe bei Registrierungen.[/de]
	*/
	public function enableRegisterWithCaptcha() {$this->bRegisterWithCaptcha = true;}
	/* @end method */

	/*
	@start method
	
	@group Security
	
	@description
	[en]Disables the captcha code input at registration.[/en]
	[de]Deaktiviert die Captcha-Codeeingabe bei Registrierungen.[/de]
	*/
	public function disableRegisterWithCaptcha() {$this->bRegisterWithCaptcha = false;}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Specifies whether captcha code input will be used for registrations.[/en]
	[de]Gibt an ob Captcha-Codeeingabe bei Registrierungen verwendet werden soll.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether captcha code input will be used for registrations.[/en]
	[de]Gibt an ob Captcha-Codeeingabe bei Registrierungen verwendet werden soll.[/de]
	*/
	public function useRegisterWithCaptcha($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bRegisterWithCaptcha = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Returns whether captcha code input will be used for registration.[/en]
	[de]Gibt zurück ob Captcha-Codeeingabe bei der Registrierung verwendet werden soll.[/de]
	
	@return bWithCaptcha [type]bool[/type]
	[en]Returns a boolean whether captcha code input will be used for registration.[/en]
	[de]Gibt einen Boolean zurück, ob Captcha-Codeeingabe bei der Registrierung verwendet werden soll.[/de]
	*/
	public function isRegisterWithCaptcha() {return $this->bRegisterWithCaptcha;}
	/* @end method */

	/*
	@start method
	
	@group Security
	
	@description
	[en]Enables the captcha code input at login.[/en]
	[de]Aktiviert die Captcha-Codeeingabe beim Login.[/de]
	*/
	public function enableLoginWithCaptcha() {$this->bLoginWithCaptcha = true;}
	/* @end method */

	/*
	@start method
	
	@group Security
	
	@description
	[en]Disables the captcha code input at login.[/en]
	[de]Deaktiviert die Captcha-Codeeingabe beim Login.[/de]
	*/
	public function disableLoginWithCaptcha() {$this->bLoginWithCaptcha = false;}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Specifies whether captcha code input will be used for login.[/en]
	[de]Gibt an ob Captcha-Codeeingabe beim Login verwendet werden soll.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether captcha code input will be used for login.[/en]
	[de]Gibt an ob Captcha-Codeeingabe beim Login verwendet werden soll.[/de]
	*/
	public function useLoginWithCaptcha($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bLoginWithCaptcha = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Returns whether captcha code input will be used for login.[/en]
	[de]Gibt zurück ob Captcha-Codeeingabe beim Login verwendet werden soll.[/de]
	
	@return bWithCaptcha [type]bool[/type]
	[en]Returns a boolean whether captcha code input will be used for login.[/en]
	[de]Gibt einen Boolean zurück, ob Captcha-Codeeingabe beim Login verwendet werden soll.[/de]
	*/
	public function isLoginWithCaptcha() {return $this->bLoginWithCaptcha;}
	/* @end method */

	/*
	@start method
	
	@group Support
	
	@description
	[en]Enables logging of actions at login.[/en]
	[de]Aktiviert loggen der Aktionen beim Login.[/de]
	*/
	public function enableActionLog() {$this->bActionLog = true;}
	/* @end method */

	/*
	@start method
	
	@group Support
	
	@description
	[en]Disables logging of actions at login.[/en]
	[de]Deaktiviert loggen der Aktionen beim Login.[/de]
	*/
	public function disableActionLog() {$this->bActionLog = false;}
	/* @end method */
	
	/*
	@start method
	
	@group Support
	
	@description
	[en]Specifies whether logging of actions will be used for login.[/en]
	[de]Gibt an ob loggen der Aktion beim Login verwendet werden soll.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether logging of actions will be used for login.[/en]
	[de]Gibt an ob loggen der Aktion beim Login verwendet werden soll.[/de]
	*/
	public function useActionLog($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bActionLog = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Support
	
	@description
	[en]Returns whether logging of actions will be used for login.[/en]
	[de]Gibt zurück ob loggen der Aktionen beim Login verwendet werden soll.[/de]
	
	@return bActionLog [type]bool[/type]
	[en]Returns a boolean whether logging of actions will be used for login.[/en]
	[de]Gibt einen Boolean zurück, ob loggen der Aktionen beim Login verwendet werden soll.[/de]
	*/
	public function isActionLog() {return $this->bActionLog;}
	/* @end method */
	
	/*
	@start method
	
	@group Registration
	
	@description
	[en]Allows website visitors to register themselves.[/en]
	[de]Erlaubt Webseitenbesucher sich selbst zu registrieren.[/de]
	*/
	public function allowRegister() {$this->bAllowRegister = true;}
	/* @end method */

	/*
	@start method
	
	@group Registration
	
	@description
	[en]Disallows website visitors to register themselves.[/en]
	[de]Verbietet Webseitenbesucher sich selbst zu registrieren.[/de]
	*/
	public function disallowRegister() {$this->bAllowRegister = false;}
	/* @end method */
	
	/*
	@start method
	
	@group Registration
	
	@description
	[en]Specifies whether website visitors can register themselves.[/en]
	[de]Gibt an ob Webseitenbesucher sich selbst registrieren dürfen.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether website visitors can register themselves.[/en]
	[de]Gibt an ob Webseitenbesucher sich selbst registrieren dürfen.[/de]
	*/
	public function useAllowRegister($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bAllowRegister = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Registration
	
	@description
	[en]Returns whether website visitors can register themselves.[/en]
	[de]Gibt zurück ob Webseitenbesucher sich selbst registrieren dürfen.[/de]
	
	@return bAllowRegister [type]bool[/type]
	[en]Returns a boolean whether website visitors can register themselves.[/en]
	[de]Gibt einen Boolean zurück, ob Webseitenbesucher sich selbst registrieren dürfen.[/de]
	*/
	public function isAllowRegister() {return $this->bAllowRegister;}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]Allows users to reset their passwords.[/en]
	[de]Erlaubt den Benutzern das Zurücksetzen ihrer Passwörter.[/de]
	*/
	public function allowPasswordReset() {$this->bAllowPasswordReset = true;}
	/* @end method */

	/*
	@start method
	
	@group Password
	
	@description
	[en]Disallows users to reset their passwords.[/en]
	[de]Verbietet den Benutzern das Zurücksetzen ihrer Passwörter.[/de]
	*/
	public function disallowPasswordReset() {$this->bAllowPasswordReset = false;}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]Specifies whether users can reset their password.[/en]
	[de]Gibt an ob Benutzer ihr Passwort zurücksetzen dürfen.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether users can reset their password.[/en]
	[de]Gibt an ob Benutzer ihr Passwort zurücksetzen dürfen.[/de]
	*/
	public function useAllowPasswordReset($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bAllowPasswordReset = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]Returns whether users are allowed to reset their password.[/en]
	[de]Gibt zurück, ob Benutzern erlaubt ist ihr Passwort zurück zu setzen.[/de]
	
	@return bAllowPasswordReset [type]bool[/type]
	[en]Returns a boolean whether users are allowed to reset their password.[/en]
	[de]Gibt einen Boolean zurück, ob Benutzern erlaubt ist ihr Passwort zurück zu setzen.[/de]
	*/
	public function isAllowPasswordReset() {return $this->bAllowPasswordReset;}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Allows users to change their username.[/en]
	[de]Erlaubt den Benutzern das Ändern ihrer Benutzernamen.[/de]
	*/
	public function allowChangeUsername() {$this->bAllowChangeUsername = true;}
	/* @end method */

	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Disallows users to change their username.[/en]
	[de]Verbietet den Benutzern das Ändern ihrer Benutzernamen.[/de]
	*/
	public function disallowChangeUsername() {$this->bAllowChangeUsername = false;}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Specifies whether users can change their username.[/en]
	[de]Gibt an ob Benutzer ihre Benutzernamen ändern dürfen.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether users can change their username.[/en]
	[de]Gibt an ob Benutzer ihre Benutzernamen ändern dürfen.[/de]
	*/
	public function useAllowChangeUsername($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bAllowChangeUsername = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Returns whether users are allowed to change their username.[/en]
	[de]Gibt zurück, ob Benutzern erlaubt ist ihren Benutzernamen zu ändern.[/de]
	
	@return bAllowChangeUsername [type]bool[/type]
	[en]Returns a boolean whether users are allowed to change their username.[/en]
	[de]Gibt einen Boolean zurück, ob Benutzern erlaubt ist ihren Benutzernamen zu ändern.[/de]
	*/
	public function isAllowChangeUsername() {return $this->bAllowChangeUsername;}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Allows users to change their email adress.[/en]
	[de]Erlaubt den Benutzern das Ändern ihrer E-Mail-Adresse.[/de]
	*/
	public function allowChangeEmail() {$this->bAllowChangeEmail = true;}
	/* @end method */

	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Disallows users to change their email adress.[/en]
	[de]Verbietet den Benutzern das Ändern ihrer E-Mail-Adresse.[/de]
	*/
	public function disallowChangeEmail() {$this->bAllowChangeEmail = false;}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Specifies whether users can change their email adress.[/en]
	[de]Gibt an ob Benutzer ihre E-Mail-Adresse ändern dürfen.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether users can change their email adress.[/en]
	[de]Gibt an ob Benutzer ihre E-Mail-Adresse ändern dürfen.[/de]
	*/
	public function useAllowChangeEmail($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bAllowChangeEmail = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Returns whether users are allowed to change their email adress.[/en]
	[de]Gibt zurück, ob Benutzern erlaubt ist ihre E-Mail-Adresse zu ändern.[/de]
	
	@return bAllowChangeEmail [type]bool[/type]
	[en]Returns a boolean whether users are allowed to change their email adress.[/en]
	[de]Gibt einen Boolean zurück, ob Benutzern erlaubt ist ihre E-Mail-Adresse zu ändern.[/de]
	*/
	public function isAllowChangeEmail() {return $this->bAllowChangeEmail;}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Allows the simultaneous, multiple login of a user without that someone is automatically logged out.[/en]
	[de]Erlaubt das gleichzeitige, mehrfache Einloggen über einen Benutzer ohne dass jemand automatisch ausgeloggt wird.[/de]
	*/
	public function enableMultiLogin() {$this->bMultiLogin = true;}
	/* @end method */

	/*
	@start method
	
	@group Security
	
	@description
	[en]Disallows the simultaneous, multiple login of a user without that someone is automatically logged out.[/en]
	[de]Verbietet das gleichzeitige, mehrfache Einloggen über einen Benutzer ohne dass jemand automatisch ausgeloggt wird.[/de]
	*/
	public function disableMultiLogin() {$this->bMultiLogin = false;}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Specifies whether it is allowed that you can log in simultaneously on a user repeatedly without anyone getting logged out automatically.[/en]
	[de]Gibt an ob es erlaubt ist, dass man sich über einen Benutzer gleichzeitig, mehrfach einloggen kann ohne dass jemand automatisch ausgeloggt wird.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether it is allowed that you can log in simultaneously on a user repeatedly without anyone getting logged out automatically.[/en]
	[de]Gibt an ob es erlaubt ist, dass man sich über einen Benutzer gleichzeitig, mehrfach einloggen kann ohne dass jemand automatisch ausgeloggt wird.[/de]
	*/
	public function useMultiLogin($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bMultiLogin = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Returns whether it is allowed that you can log in simultaneously on a user repeatedly without anyone getting logged out automatically.[/en]
	[de]Gibt zurück ob es erlaubt ist, dass man sich über einen Benutzer gleichzeitig, mehrfach einloggen kann ohne dass jemand automatisch ausgeloggt wird.[/de]
	
	@return bMultiLogin [type]bool[/type]
	[en]Returns a boolean whether it is allowed that you can log in simultaneously on a user repeatedly without anyone getting logged out automatically.[/en]
	[de]Gibt einen Boolean zurück ob es erlaubt ist, dass man sich über einen Benutzer gleichzeitig, mehrfach einloggen kann ohne dass jemand automatisch ausgeloggt wird.[/de]
	*/
	public function isMultiLogin() {return $this->bMultiLogin;}
	/* @end method */
	
	/*
	@start method
	
	@group Settings
	
	@description
	[en]...[/en]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useRequireUsername($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bRequireUsername = $_bUse;
	}
	/* @end method */
	
	
	/*
	@start method
	
	@group Settings
	
	@description
	[en]...[/en]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useRequireEmail($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bRequireEmail = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Settings
	
	@description
	[en]...[/en]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useEmailAsUsername($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bEmailAsUsername = $_bUse;
	}
	/* @end method */

	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Sets the minimum number of characters that requires a username.[/en]
	[de]Setzt die Mindestanzahl an Zeichen die ein Benutzername benötigt.[/de]
	
	@param iCount [needed][type]int[/type]
	[en]The number of required characters as an integer.[/en]
	[de]Die Anzahl an Zeichen die benötigt wird als Integer.[/de]
	*/
	public function setMinCharCountUsername($_iCount)
	{
		$_iCount = $this->getRealParameter(array('oParameters' => $_iCount, 'sName' => 'iCount', 'xParameter' => $_iCount));
		$this->iMinCharCountUsername = $_iCount;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Returns the number of characters required for usernames.[/en]
	[de]Gibt die Anzahl der benötigten Zeichen für Benutzernamen zurück.[/de]
	
	@return iMinCharCount [type]int[/type]
	[en]Returns the number of characters required for usernames as an integer.[/en]
	[de]Gibt die Anzahl der benötigten Zeichen für Benutzernamen als Integer zurück.[/de]
	*/
	public function getMinCharCountUsername() {return $this->iMinCharCountUsername;}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]Sets the minimum number of characters that requires a password.[/en]
	[de]Setzt die Mindestanzahl an Zeichen die ein Passwort benötigt.[/de]
	
	@param iCount [needed][type]int[/type]
	[en]The number of required characters as an integer.[/en]
	[de]Die Anzahl an Zeichen die benötigt wird als Integer.[/de]
	*/
	public function setMinCharCountPassword($_iCount)
	{
		$_iCount = $this->getRealParameter(array('oParameters' => $_iCount, 'sName' => 'iCount', 'xParameter' => $_iCount));
		$this->iMinCharCountPassword = $_iCount;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]Returns the number of characters required for passwords.[/en]
	[de]Gibt die Anzahl der benötigten Zeichen für Passwörter zurück.[/de]
	
	@return iMinCharCount [type]int[/type]
	[en]The number of required characters as an integer.[/en]
	[de]Die Anzahl an Zeichen die benötigt wird als Integer.[/de]
	*/
	public function getMinCharCountPassword() {return $this->iMinCharCountPassword;}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Sets the type of the user.[/en]
	[de]Setzt den Typ des Benutzers.[/de]
	
	@param iType [needed][type]int[/type]
	[en]
		The type of the user as integer.
		The following types are possible:
		%LoginUserTypes%
	[/en]
	[de]
		Der Typ des Benutzers als Integer.
		Folgende Typen sind möglich:
		%LoginUserTypes%
	[/de]
	*/
	private function setUserType($_iType)
	{
		$_iType = $this->getRealParameter(array('oParameters' => $_iType, 'sName' => 'iType', 'xParameter' => $_iType));
		$this->iUserType |= ($_iType);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Unsets the type of the user.[/en]
	[de]Hebt den Typ des Buntzers auf.[/de]
	
	@param iType [needed][type]int[/type]
	[en]
		The type of the user as integer.
		The following types are possible:
		%LoginUserTypes%
	[/en]
	[de]
		Der Typ des Benutzers als Integer.
		Folgende Typen sind möglich:
		%LoginUserTypes%
	[/de]
	*/
	private function unsetUserType($_iType)
	{
		$_iType = $this->getRealParameter(array('oParameters' => $_iType, 'sName' => 'iType', 'xParameter' => $_iType));
		$this->iUserType &= ~($_iType);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]toggles the type of the user on or off.[/en]
	[de]Schaltet den Typ des Benutzers an oder aus.[/de]
	
	@param iType [needed][type]int[/type]
	[en]
		The type of the user as integer.
		The following types are possible:
		%LoginUserTypes%
	[/en]
	[de]
		Der Typ des Benutzers als Integer.
		Folgende Typen sind möglich:
		%LoginUserTypes%
	[/de]
	*/
	private function toggleUserType($_iType)
	{
		$_iType = $this->getRealParameter(array('oParameters' => $_iType, 'sName' => 'iType', 'xParameter' => $_iType));
		$this->iUserType ^= ($_iType);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Returns the type of the user.[/en]
	[de]Gibt den Typ des Benutzers zurück.[/de]
	
	@return iUserType [type]int[/type]
	[en]
		Returns the type of the user as integer.
		The following types are possible:
		%LoginUserTypes%
	[/en]
	[de]
		Gibt den Typ des Benutzers als Integer zurück.
		Folgende Typen sind möglich:
		%LoginUserTypes%
	[/de]
	*/
	public function getUserType() {return $this->iUserType;}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Returns whether the type of the logged in user is a specific type of user.[/en]
	[de]Gibt zurück, ob der Typ des eingeloggte Benutzer von einem bestimmten Benutzertyp ist.[/de]
	
	@return bIsUserType [type]bool[/type]
	[en]Returns a boolean whether the type of the logged in user is a specific type of user.[/en]
	[de]Gibt einen Boolean zurück, ob der Typ des eingeloggte Benutzer von einem bestimmten Benutzertyp ist.[/de]
	
	@param iType [needed][type]int[/type]
	[en]
		The user type to be tested.
		The following user types are possible:
		%LoginUserTypes%
	[/en]
	[de]
		Der Benutzertyp der geprüft werden soll.
		Die folgenden Benutzertypen sind möglich:
		%LoginUserTypes%
	[/de]
	*/
	public function isUserType($_iType)
	{
		$_iType = $this->getRealParameter(array('oParameters' => $_iType, 'sName' => 'iType', 'xParameter' => $_iType));
		return ($this->iUserType & ($_iType));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Returns whether the type of the user is a guest. (not logged in)[/en]
	[de]Gibt zurück, ob der Typ des Benutzers ein Gast ist. (Nicht eingeloggt)[/de]
	
	@return bIsGuest [type]bool[/type]
	[en]Returns a boolean whether the type of the user is a guest. (not logged in)[/en]
	[de]Gibt einen Boolean zurück, ob der Typ des Benutzers ein Gast ist. (Nicht eingeloggt)[/de]
	*/
	public function isGuest() {if ($this->iUserType == PG_LOGIN_USERTYPE_GUEST) {return true;} return false;}
	/* @end method */

	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Set columns that are to be read in addition.[/en]
	[de]Setzt Spalten die zusätzlich ausgelesen werden sollen.[/de]
	
	@param sSelect [needed][type]string[/type]
	[en]The columns that are to be read in addition.[/en]
	[de]Die Spalten die zusätzlich ausgelesen werden sollen.[/de]
	*/
	public function setAdditionalSelect($_sSelect)
	{
		$_sSelect = $this->getRealParameter(array('oParameters' => $_sSelect, 'sName' => 'sSelect', 'xParameter' => $_sSelect));
		$this->sAdditionalSelect = $_sSelect;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Returns the columns that are to be read in addition.[/en]
	[de]Gibt die Spalten zurück, die zusätzlich ausgelesen werden sollen.[/de]
	
	@return sSelect [type]string[/type]
	[en]Returns the columns that are to be read in addition as a string.[/en]
	[de]Gibt die Spalten als String zurück, die zusätzlich ausgelesen werden sollen.[/de]
	*/
	public function getAdditionalSelect() {return $this->sAdditionalSelect;}
	/* @end method */

	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Returns data about the user logged-on.[/en]
	[de]Gibt Daten über den angemeldeten Benutzer zurück.[/de]
	
	@return xValue [type]mixed[/type]
	[en]Returns the value of the desired data to the user logged-on.[/en]
	[de]Gibt den Wert der gewünschten Daten zu dem angemeldeten Benutzer zurück.[/de]
	
	@param sProperty [needed][type]string[/type]
	[en]The name of the data to be requested.[/en]
	[de]Der Name der Daten, die angefordert werden sollen.[/de]
	*/
	public function getUserData($_sProperty = NULL)
	{
		$_sProperty = $this->getRealParameter(array('oParameters' => $_sProperty, 'sName' => 'sProperty', 'xParameter' => $_sProperty));
		if ($_sProperty === NULL)
        {
            $_axUserData = $this->axLoginData;
            if (!empty($_axUserData['Password'])) {$_axUserData['Password'] = ''; unset($_axUserData['Password']);}
            if (!empty($_axUserData['ReloginPassword'])) {$_axUserData['ReloginPassword'] = ''; unset($_axUserData['ReloginPassword']);}
            if (!empty($_axUserData['Access'])) {$_axUserData['Access'] = ''; unset($_axUserData['Access']);}
            return $_axUserData;
        }
        return isset($this->axLoginData[$_sProperty]) ? $this->axLoginData[$_sProperty] : '';
	}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Sets data about the user logged-on. (The data used only temporarily and are not saved!)[/en]
	[de]Setzt Daten über den angemeldeten Benutzer. (Die Daten werden nur temporär gesetzt und nicht gespeichert!)[/de]
	
	@param sProperty [needed][type]string[/type]
	[en]The name of the data to be set.[/en]
	[de]Der Name der Daten, die gesetzt werden sollen.[/de]
	
	@param xValue [needed][type]mixed[/type]
	[en]The value should be used.[/en]
	[de]Der Wert der gesetzt werden soll.[/de]
	*/
	public function setUserData($_sProperty, $_xValue = NULL)
	{
		$_xValue = $this->getRealParameter(array('oParameters' => $_sProperty, 'sName' => 'xValue', 'xParameter' => $_xValue));
		$_sProperty = $this->getRealParameter(array('oParameters' => $_sProperty, 'sName' => 'sProperty', 'xParameter' => $_sProperty));
		if ($_sProperty != 'UserID') {$this->axLoginData[$_sProperty] = $_xValue;}
	}
	/* @end method */

	/*
	@start method
	
	@group Settings
	
	@description
	[en]Sets a global, absolute URL for example Confirmation e-mails.[/en]
	[de]Setzt eine globale, absolute URL für z.B. Bestätigungs-Mails.[/de]
	
	@param sUrl [needed][type]string[/type]
	[en]The global, absolute path or URL to the login.[/en]
	[de]Der globale, absolte Pfad bzw. URL zum Login.[/de]
	*/
	public function setLoginGlobalUrl($_sUrl)
	{
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		$this->sLoginGlobalUrl = $_sUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Settings
	
	@description
	[en]The file path to the confirmation script for password resetting.[/en]
	[de]Der Dateipfad zum Bestätigungsscript für Passwörter zurück zu setzen.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file path to the script.[/en]
	[de]Der Dateipfad zum Script.[/de]
	*/
	public function setPasswordResetAcceptFilePath($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$this->sPasswordResetAcceptFilePath = $_sFile;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Settings
	
	@description
	[en]The file path to the confirmation script for account registration.[/en]
	[de]Der Dateipfad zum Bestätigungsscript für Account Registrierungen.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file path to the script.[/en]
	[de]Der Dateipfad zum Script.[/de]
	*/
	public function setAccountAcceptFilePath($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$this->sAccountAcceptFilePath = $_sFile;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function useAutoGeneratePassword($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bAutoGeneratePassword = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function useDisplayPassword($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bDisplayPassword = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function useSendAcceptRequestEmail($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bSendAcceptRequestEmail = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function useSendAcceptSuccessEmail($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bSendAcceptSuccessEmail = $_bUse;
	}
	/* @end method */
	
	/*
	public function useSendAcceptFailedEmail($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bSendAcceptFailedEmail = $_bUse;
	}
	*/
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param sMails [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function setMailAcceptToEmails($_sMails)
	{
		$_sMails = $this->getRealParameter(array('oParameters' => $_sMails, 'sName' => 'sMails', 'xParameter' => $_sMails));
		$this->sMailAcceptToEmails = $_sMails;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function useMailAcceptToSystemEmail($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bMailAcceptToSystemEmail = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param sMails [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function setMailAcceptSuccessToEmails($_sMails)
	{
		$_sMails = $this->getRealParameter(array('oParameters' => $_sMails, 'sName' => 'sMails', 'xParameter' => $_sMails));
		$this->sMailAcceptSuccessToEmails = $_sMails;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function useMailAcceptSuccessToSystemEmail($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bMailAcceptSuccessToSystemEmail = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param sMails [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function setMailAcceptFailedToEmails($_sMails)
	{
		$_sMails = $this->getRealParameter(array('oParameters' => $_sMails, 'sName' => 'sMails', 'xParameter' => $_sMails));
		$this->sMailAcceptFailedToEmails = $_sMails;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function useMailAcceptFailedToSystemEmail($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bMailAcceptFailedToSystemEmail = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]...[/en]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useSendRegisterFailedMail($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bSendRegisterFailedEmail = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]...[/en]
	
	@param sSubject [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setMailRegisterFailedSubject($_sSubject)
	{
		$_sSubject = $this->getRealParameter(array('oParameters' => $_sSubject, 'sName' => 'sSubject', 'xParameter' => $_sSubject));
		$this->sMailRegisterFailedSubject = $_sSubject;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setMailRegisterFailedMessage($_sMessage)
	{
		$_sMessage = $this->getRealParameter(array('oParameters' => $_sMessage, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		$this->sMailRegisterFailedMessage = $_sMessage;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]...[/en]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useMailRegisterFailedToSystemEmail($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bMailRegisterFailedToSystemEmail = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]...[/en]
	
	@param sEmails [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setMailRegisterFailedEmails($_sEmails)
	{
		$_sEmails = $this->getRealParameter(array('oParameters' => $_sEmails, 'sName' => 'sEmails', 'xParameter' => $_sEmails));
		$this->sMailRegisterFailedToEmails = $_sEmails;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]Sets the email address to be used as the sender for messages from the system.[/en]
	[de]Setzt die E-Mail-Adresse, die als Absender für Nachrichten vom System verwendet werden soll.[/de]
	
	@param sEmail [needed][type]string[/type]
	[en]The email address.[/en]
	[de]Die E-Mail-Adresse.[/de]
	*/
	public function setSystemEmail($_sEmail)
	{
		$_sEmail = $this->getRealParameter(array('oParameters' => $_sEmail, 'sName' => 'sEmail', 'xParameter' => $_sEmail));
		$this->sSystemEmail = $_sEmail;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]Sets the title for your system, which is used in emails. The title is important, because user otherwise don't know exactly from which system the email was sent.[/en]
	[de]Setzt den Titel für Ihr System, der bei E-Mails verwendet wird. Der Titel ist wichtig, da Benutzer sonst nicht genau wissen von welchem System die E-Mail gesendet wurde.[/de]
	
	@param sTitle [needed][type]string[/type]
	[en]The title / name of your system / website.[/en]
	[de]Der Titel / Name ihres Systems / ihrer Webseite.[/de]
	*/
	public function setSystemTitle($_sTitle)
	{
		$_sTitle = $this->getRealParameter(array('oParameters' => $_sTitle, 'sName' => 'sTitle', 'xParameter' => $_sTitle));
		$this->sSystemTitle = $_sTitle;
	}
	/* @end method */

	/*
	@start method
	
	@group Informations
	
	@description
	[en]Sets the URL to the page on which the privacy policies are.[/en]
	[de]Setzt die URL zur Seite an der die Datenschutzerklärungen stehen.[/de]
	
	@param sUrl [needed][type]string[/type]
	[en]The URL to the page on which the privacy policies are.[/en]
	[de]Die URL zur Seite an der die Datenschutzerklärungen stehen.[/de]
	*/
	public function setPrivacyPolicyUrl($_sUrl)
	{
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		$this->sPrivacyPolicyUrl = $_sUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Informations
	
	@description
	[en]Returns the URL to the page on which the privacy policies are.[/en]
	[de]Gibt die URL zur Seite auf der die Datenschutzerklärungen stehen zurück.[/de]
	
	@return sUrl [type]string[/type]
	[en]Returns the URL to the page on which the privacy policies are as a string.[/en]
	[de]Gibt die URL zur Seite auf der die Datenschutzerklärungen stehen als String zurück.[/de]
	*/
	public function getPrivacyPolicyUrl() {return $this->sPrivacyPolicyUrl;}
	/* @end method */

	/*
	@start method
	
	@group Informations
	
	@description
	[en]Sets the URL to the page on which the privacy terms are.[/en]
	[de]Setzt die URL zur Seite an der die Datenschutzrichtlinien stehen.[/de]
	
	@param sUrl [needed][type]string[/type]
	[en]The URL to the page on which the privacy terms are.[/en]
	[de]Die URL zur Seite an der die Datenschutzrichtlinien stehen.[/de]
	*/
	public function setPrivacyTermsUrl($_sUrl)
	{
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		$this->sPrivacyTermsUrl = $_sUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Informations
	
	@description
	[en]Returns the URL to the page on which the privacy terms are.[/en]
	[de]Gibt die URL zur Seite auf der die Datenschutzrichtlinien stehen zurück.[/de]
	
	@return sUrl [type]string[/type]
	[en]Returns the URL to the page on which the privacy terms are as a string.[/en]
	[de]Gibt die URL zur Seite auf der die Datenschutzrichtlinien stehen als String zurück.[/de]
	*/
	public function getPrivacyTermsUrl() {return $this->sPrivacyTermsUrl;}
	/* @end method */
	
	/*
	@start method
	
	@group Informations
	
	@description
	[en]Sets the URL to the page on which the terms of use are.[/en]
	[de]Setzt die URL zur Seite an der die Nutzungsbedingungen stehen.[/de]
	
	@param sUrl [needed][type]string[/type]
	[en]The URL to the page on which the terms of use are.[/en]
	[de]Die URL zur Seite an der die Nutzungsbedingungen stehen.[/de]
	*/
	public function setTermsOfUseUrl($_sUrl)
	{
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		$this->sTermsOfUseUrl = $_sUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Informations
	
	@description
	[en]Returns the URL to the page on which the terms of use are.[/en]
	[de]Gibt die URL zur Seite auf der die Nutzungsbedingungen stehen zurück.[/de]
	
	@return sUrl [type]string[/typ]
	[en]Returns the URL to the page on which the terms of use are as a string.[/en]
	[de]Gibt die URL zur Seite auf der die Nutzungsbedingungen stehen als String zurück.[/de]
	*/
	public function getTermsOfUseUrl() {return $this->sTermsOfUseUrl;}
	/* @end method */
	
	/*
	@start method
	
	@group Informations
	
	@description
	[en]Sets the URL to the page on which the terms and conditions are.[/en]
	[de]Setzt die URL zur Seite an der die Geschäftsbedingungen stehen.[/de]
	
	@param sUrl [needed][type]string[/string]
	[en]The URL to the page on which the terms and conditions are.[/en]
	[de]Die URL zur Seite an der die Geschäftsbedingungen stehen.[/de]
	*/
	public function setTermsAndConditionsUrl($_sUrl)
	{
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		$this->sTermsAndConditionsUrl = $_sUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Informations
	
	@description
	[en]Returns the URL to the page on which the terms and conditions are.[/en]
	[de]Gibt die URL zur Seite auf der die Geschäftsbedingungen stehen zurück.[/de]
	
	@return sUrl [type]string[/type]
	[en]Returns the URL to the page on which the terms and conditions are as a string.[/en]
	[de]Gibt die URL zur Seite auf der die Geschäftsbedingungen stehen als String zurück.[/de]
	*/
	public function getTermsAndConditionsUrl() {return $this->sTermsAndConditionsUrl;}
	/* @end method */

	/*
	@start method
	
	@group UserdataForm
	
	@description
	[en]Returns the names of the required fields which have failed.[/en]
	[de]Gibt die Namen der benätigten Felder die fehlgeschlagen sind zurück.[/de]
	
	@return asRequiredFailed [type]string[][/type]
	[en]Returns the names of the required fields which have failed as an string array.[/en]
	[de]Gibt die Namen der benätigten Felder die fehlgeschlagen sind als String-Array zurück.[/de]
	*/
	public function getRequiredFailed()
	{
		return $this->asRequiredFailed;
	}
	/* @end method */
	
	/*
	@start method
	
	@group UserdataForm
	
	@description
	[en]Checks if all required fields are completed.[/en]
	[de]Prüft ob alle Pflichtfelder ausgefüllt wurden.[/de]
	
	@return bRequirementsOk [type]bool[/type]
	[en]Returns a boolean whether all required fields have been filled out.[/en]
	[de]Gibt einen Boolean zurück ob alle Pflichtfelder ausgefüllt wurden.[/de]
	
	@param asFilled [needed][type]string[][/type]
	[en]The fields that have been transferred by the form. Usually this is $_POST.[/en]
	[de]Die Felder, die vom Formular übertragen wurden. In der Regel ist das $_POST.[/de]
	
	@param bPasswordRequired [needed][type]bool[/type]
	[en]Specifies whether the password field is a required field also when data changes.[/en]
	[de]Gibt an ob das Passwortfeld auch bei Änderungen der Daten ein Pflichtfeld ist.[/de]
	
	@param asRequired [type]string[][/type]
	[en]The required fields as a string array to be tested in addition to username, password and e-mail.[/en]
	[de]Die Pflichtfelder als String-Array, die zusätzlich zu Benutzername, Passwort und E-Mail geprüft werden sollen.[/de]
	*/
	public function checkRequiredFields($_asFilled, $_bPasswordRequired = NULL, $_asRequired = NULL)
	{
		$_bPasswordRequired = $this->getRealParameter(array('oParameters' => $_asFilled, 'sName' => 'bPasswordRequired', 'xParameter' => $_bPasswordRequired));
		$_asRequired = $this->getRealParameter(array('oParameters' => $_asFilled, 'sName' => 'asRequired', 'xParameter' => $_asRequired));
		$_asFilled = $this->getRealParameter(array('oParameters' => $_asFilled, 'sName' => 'asFilled', 'xParameter' => $_asFilled, 'bNotNull' => true));

		if ($_asFilled === NULL) {global $_POST; $_asFilled = $_POST;}
		if ($_asRequired === NULL) {$_asRequired = $this->asRequired;}
		
		$_bNewUser = true;
		
		if (isset($_asFilled['iUserID']))
		{
			if (!empty($_asFilled['iUserID']))
			{
				$_bNewUser = false;
				for ($i=0; $i<count($_asRequired); $i++)
				{
					if (($this->bAllowChangeUsername == false) && ($_asRequired[$i] == 'sUsername')) {$_asRequired[$i] = '';}
					if (($this->bAllowChangeEmail == false) && ($_asRequired[$i] == 'sEmail')) {$_asRequired[$i] = '';}
				}
			}
		}
		
		if (($this->bRequireUsername == false) || ($this->bRequireEmail == false))
		{
			for ($i=0; $i<count($_asRequired); $i++)
			{
				if (($this->bRequireUsername == false) && ($_asRequired[$i] == 'sUsername')) {$_asRequired[$i] = '';}
				if (($this->bRequireEmail == false) && ($_asRequired[$i] == 'sEmail')) {$_asRequired[$i] = '';}
			}
		}
		
		$this->asRequiredFailed = array();
		if ((($_bNewUser == true) || ($this->bAllowChangeEmail == true)) && ($this->bRequireEmail == true))
		{
			if ((isset($_asFilled['sEmail'])) && (isset($_asFilled['sEmailRetype'])))
			{
				if (trim($_asFilled['sEmail']) != trim($_asFilled['sEmailRetype']))
				{
					$this->asRequiredFailed[] = 'sEmailRetype';
				}
			}
			else {$this->asRequiredFailed[] = 'sEmailRetype';}
		}
		
		for ($i=0; $i<count($_asRequired); $i++)
		{
			if ($_asRequired[$i] != '')
			{
				if (isset($_asFilled[$_asRequired[$i]]))
				{
					if ($_asFilled[$_asRequired[$i]] == '') {$this->asRequiredFailed[] = $_asRequired[$i];}
				}
				else {$this->asRequiredFailed[] = $_asRequired[$i];}
			}
		}
		
		if (count($this->asRequiredFailed) > 0) {return false;}

		// Password...
		if ($_bPasswordRequired == true)
		{
			if (isset($_asFilled['iUserID']))
			{
				if (!empty($_asFilled['iUserID']))
				{
					if (!$this->isUserType(array('iType' => PG_LOGIN_USERTYPE_ADMIN | PG_LOGIN_USERTYPE_SUPERADMIN)))
					{
						if (!isset($_asFilled['sOldPassword'])) {return false;}
						if (trim($_asFilled['sOldPassword']) == '') {return false;}
					}
				}
			}
			
			if (isset($_asFilled['sPassword']))
			{
				if (!isset($_asFilled['sPasswordRetype'])) {return false;}
				if (trim($_asFilled['sPassword']) == '') {return false;}
				if (trim($_asFilled['sPasswordRetype']) == '') {return false;}
				if (trim($_asFilled['sPassword']) != trim($_asFilled['sPasswordRetype'])) {return false;}
			}
			else if (!isset($_asFilled['iUserID'])) {return false;}
			else {if (empty($_asFilled['iUserID'])) {return false;}}
		}

		return true;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Administration
	
	@description
	[en]Bans a user from the system. The user can not log in anymore.[/en]
	[de]Bannt einen Benutzer vom System. Der Benutzer kann sich nicht mehr einloggen.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether the user successfully banned.[/en]
	[de]Gibt einen Boolean zurück, ob der Benutzer erfolgreich gebannt wurde.[/de]
	
	@param iUserID [type]int[/type]
	[en]The user ID of the user to be banned.[/en]
	[de]Die Benutzer ID des zu bannenden Benutzers.[/de]
	
	@param sUsername [type]string[/type]
	[en]The username of the user to be banned.[/en]
	[de]Der Benutzername des zu bannenden Benutzers.[/de]
	
	@param sEmail [type]string[/type]
	[en]The email adress of the user to be banned.[/en]
	[de]Die E-Mail-Adresse des zu bannenden Benutzers.[/de]
	
	@param bBan [type]bool[/type]
	[en]Specifies whether the user should be banned (true) or released again (false).[/en]
	[de]Gibt an ob der Benutzer gebannt (true) oder wieder freigegeben (false) werden soll.[/de]
	*/
	public function banUser($_iUserID, $_sUsername = NULL, $_sEmail = NULL, $_bBan = NULL)
	{
		$_sUsername = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		$_sEmail = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sEmail', 'xParameter' => $_sEmail));
		$_bBan = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'bBan', 'xParameter' => $_bBan));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		
		if ($_bBan === NULL) {$_bBan = true;}

		if (($_iUserID !== NULL) && ($_iUserID > 0)) {return $this->banUserByID(array('iUserID' => $_iUserID, 'bBan' => $_bBan));}
		else if (($_sUsername !== NULL) && ($_sUsername !== '')) {return $this->banUserByUsername(array('sUsername' => $_sUsername, 'bBan' => $_bBan));}
		else if(($_sEmail !== NULL) && ($_sEmail !== '')) {return $this->banUserByEmail(array('sEmail' => $_sEmail, 'bBan' => $_bBan));}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Administration
	
	@description
	[en]Bans a user from the system. The user can not log in anymore.[/en]
	[de]Bannt einen Benutzer vom System. Der Benutzer kann sich nicht mehr einloggen.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether the user successfully banned.[/en]
	[de]Gibt einen Boolean zurück, ob der Benutzer erfolgreich gebannt wurde.[/de]
	
	@param iUserID [needed][type]int[/type]
	[en]The user ID of the user to be banned.[/en]
	[de]Die Benutzer ID des zu bannenden Benutzers.[/de]
	
	@param bBan [type]bool[/type]
	[en]Specifies whether the user should be banned (true) or released again (false).[/en]
	[de]Gibt an ob der Benutzer gebannt (true) oder wieder freigegeben (false) werden soll.[/de]
	*/
	public function banUserByID($_iUserID, $_bBan = NULL)
	{
		$_bBan = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'bBan', 'xParameter' => $_bBan));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		
		if ($_bBan === NULL) {$_bBan = true;}

		$this->checkDatabaseConnection();
		
		if (($this->isUserType(array('iType' => PG_LOGIN_USERTYPE_ADMIN | PG_LOGIN_USERTYPE_SUPERADMIN))))
		{			
			$_axColumnsAndValues = array();
			if ($_bBan == true) {$_axColumnsAndValues['Banned'] = 1;} else {$_axColumnsAndValues['Banned'] = 0;}
			
			return $this->updateDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'user', 
					'sIDColumn' => 'UserID', 
					'xIDValue' => $_iUserID, 
					'axColumnsAndValues' => $_axColumnsAndValues, 
					'xWhere' => NULL,
					'bStripSlashes' => false
				)
			);
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Administration
	
	@description
	[en]Bans a user from the system. The user can not log in anymore.[/en]
	[de]Bannt einen Benutzer vom System. Der Benutzer kann sich nicht mehr einloggen.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether the user successfully banned.[/en]
	[de]Gibt einen Boolean zurück, ob der Benutzer erfolgreich gebannt wurde.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The username of the user to be banned.[/en]
	[de]Der Benutzername des zu bannenden Benutzers.[/de]
	
	@param bBan [type]bool[/type]
	[en]Specifies whether the user should be banned (true) or released again (false).[/en]
	[de]Gibt an ob der Benutzer gebannt (true) oder wieder freigegeben (false) werden soll.[/de]
	*/
	public function banUserByUsername($_sUsername, $_bBan = NULL)
	{
		$_bBan = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'bBan', 'xParameter' => $_bBan));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sUsername', 'xParameter' => $_sUsername));

		if ($_bBan === NULL) {$_bBan = true;}
		
		$this->checkDatabaseConnection();
		
		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'user', 
					'asColumns' => array('UserID'), 
                    'xWhere' => array('Username' => array('LIKE' => $this->realEscapeDatabaseString(array('xString' => trim($_sUsername))))),
					'iStart' => NULL, 
					'iCount' => 1,
					'sOrderBy' => NULL, 
					'bOrderReverse' => NULL
				)
			)
		)
		{
			if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
			{
				if ($_axUser['UserID'] > 0) {return $this->banUserByID(array('iUserID' => $_axUser['UserID'], 'bBan' => $_bBan));}
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Administration
	
	@description
	[en]Bans a user from the system. The user can not log in anymore.[/en]
	[de]Bannt einen Benutzer vom System. Der Benutzer kann sich nicht mehr einloggen.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether the user successfully banned.[/en]
	[de]Gibt einen Boolean zurück, ob der Benutzer erfolgreich gebannt wurde.[/de]
	
	@param sEmail [needed][type]string[/type]
	[en]The email adress of the user to be banned.[/en]
	[de]Die E-Mail-Adresse des zu bannenden Benutzers.[/de]
	
	@param bBan [type]bool[/type]
	[en]Specifies whether the user should be banned (true) or released again (false).[/en]
	[de]Gibt an ob der Benutzer gebannt (true) oder wieder freigegeben (false) werden soll.[/de]
	*/
	public function banUserByEmail($_sEmail, $_bBan = NULL)
	{
		$_bBan = $this->getRealParameter(array('oParameters' => $_sEmail, 'sName' => 'bBan', 'xParameter' => $_bBan));
		$_sEmail = $this->getRealParameter(array('oParameters' => $_sEmail, 'sName' => 'sEmail', 'xParameter' => $_sEmail));

		if ($_bBan === NULL) {$_bBan = true;}
		
		$this->checkDatabaseConnection();
		
		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'user', 
					'asColumns' => array('UserID'), 
                    'xWhere' => array('Email' => array('LIKE' => $this->realEscapeDatabaseString(array('xString' => trim($_sEmail))))),
					'iStart' => NULL, 
					'iCount' => 1,
					'sOrderBy' => NULL, 
					'bOrderReverse' => NULL
				)
			)
		)
		{
			if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
			{
				if ($_axUser['UserID'] > 0) {return $this->banUserByID(array('iUserID' => $_axUser['UserID'], 'bBan' => $_bBan));}
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Sets the status of a user whether he has already accepted the registration on the confirmation e-mail.[/en]
	[de]Setzt den Status eines Benutzers ob er die Registrierung �ber die Bestätigungs-Mail bereits akzeptiert hat.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns or sets whether the acceptance was successful.[/en]
	[de]Gibt zurück ob das Akzeptieren erfolgreich war.[/de]
	
	@param iUserID [type]int[/type]
	[en]The user ID of the user to be accepted.[/en]
	[de]Die Benutzer ID des zu akzeptierenden Benutzers.[/de]
	
	@param sUsername [type]string[/type]
	[en]The username of the user to be accepted.[/en]
	[de]Der Benutzername des zu akzeptierenden Benutzers.[/de]
	
	@param sEmail [type]string[/type]
	[en]The email adress of the user to be accepted.[/en]
	[de]Die E-Mail-Adresse des zu akzeptierenden Benutzers.[/de]
	
	@param bAccept [type]bool[/type]
	[en]Specifies whether the user should be accepted (true) or cancelled (false).[/en]
	[de]Gibt an ob die Registrierung des Benutzers akzeptiert (true) oder storniert (false) werden soll.[/de]
	*/
	public function acceptUser($_iUserID, $_sUsername = NULL, $_sEmail = NULL, $_bAccept = NULL)
	{
		$_sUsername = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		$_sEmail = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sEmail', 'xParameter' => $_sEmail));
		$_bAccept = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'bAccept', 'xParameter' => $_bAccept));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));

		if (($_iUserID !== NULL) && ($_iUserID > 0)) {return $this->acceptUserByID(array('iUserID' => $_iUserID, 'bAccept' => $_bAccept));}
		else if (($_sUsername !== NULL) && ($_sUsername !== '')) {return $this->acceptUserByUsername(array('sUsername' => $_sUsername, 'bAccept' => $_bAccept));}
		else if(($_sEmail !== NULL) && ($_sEmail !== '')) {return $this->acceptUserByEmail(array('sEmail' => $_sEmail, 'bAccept' => $_bAccept));}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Sets the status of a user whether he has already accepted the registration on the confirmation e-mail.[/en]
	[de]Setzt den Status eines Benutzers ob er die Registrierung über die Bestätigungs-Mail bereits akzeptiert hat.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns or sets whether the acceptance was successful.[/en]
	[de]Gibt zurück ob das Akzeptieren erfolgreich war.[/de]
	
	@param iUserID [needed][type]int[/type]
	[en]The user ID of the user to be accepted.[/en]
	[de]Die Benutzer ID des zu akzeptierenden Benutzers.[/de]
	
	@param bAccept [type]bool[/type]
	[en]Specifies whether the user should be accepted (true) or cancelled (false).[/en]
	[de]Gibt an ob die Registrierung des Benutzers akzeptiert (true) oder storniert (false) werden soll.[/de]
	*/
	public function acceptUserByID($_iUserID, $_bAccept = NULL)
	{
		$_bAccept = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'bAccept', 'xParameter' => $_bAccept));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		
		if ($_bAccept === NULL) {$_bAccept = true;}

		$this->checkDatabaseConnection();
		
		$_axColumnsAndValues = array();
		if ($_bAccept == true) {$_axColumnsAndValues['Accepted'] = 1;} else {$_axColumnsAndValues['Accepted'] = 0;}
		
		return $this->updateDatasets(
			array(
				'sTable' => $this->getDatabaseTablePrefix().'user', 
				'sIDColumn' => 'UserID', 
				'xIDValue' => $_iUserID, 
				'axColumnsAndValues' => $_axColumnsAndValues, 
				'xWhere' => NULL,
				'bStripSlashes' => NULL,
                'bAllowAnonymUpdate' => true
			)
		);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Sets the status of a user whether he has already accepted the registration on the confirmation e-mail.[/en]
	[de]Setzt den Status eines Benutzers ob er die Registrierung über die Bestätigungsmail bereits akzeptiert hat.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns or sets whether the acceptance was successful.[/en]
	[de]Gibt zurück ob das Akzeptieren erfolgreich war.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The username of the user to be accepted.[/en]
	[de]Der Benutzername des zu akzeptierenden Benutzers.[/de]
	
	@param bAccept [type]bool[/type]
	[en]Specifies whether the user should be accepted (true) or cancelled (false).[/en]
	[de]Gibt an ob die Registrierung des Benutzers akzeptiert (true) oder storniert (false) werden soll.[/de]
	*/
	public function acceptUserByUsername($_sUsername, $_bAccept = NULL)
	{
		$_bAccept = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'bAccept', 'xParameter' => $_bAccept));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		
		if ($_bAccept === NULL) {$_bAccept = true;}

		$this->checkDatabaseConnection();
		
		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'user', 
					'asColumns' => array('UserID'), 
                    'xWhere' => array('Username' => array('LIKE' => $this->realEscapeDatabaseString(array('xString' => trim($_sUsername))))),
					'iStart' => NULL, 
					'iCount' => 1,
					'sOrderBy' => NULL, 
					'bOrderReverse' => NULL
				)
			)
		)
		{
			if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
			{
				if ($_axUser['UserID'] > 0) {return $this->acceptUserByID(array('iUserID' => $_axUser['UserID'], 'bAccept' => $_bAccept));}
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Sets the status of a user whether he has already accepted the registration on the confirmation e-mail.[/en]
	[de]Setzt den Status eines Benutzers ob er die Registrierung über die Bestätigungsmail bereits akzeptiert hat.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns or sets whether the acceptance was successful.[/en]
	[de]Gibt zurück ob das Akzeptieren erfolgreich war.[/de]
	
	@param sEmail [needed][type]string[/type]
	[en]The email adress of the user to be accepted.[/en]
	[de]Die E-Mail-Adresse des zu akzeptierenden Benutzers.[/de]
	
	@param bAccept [type]bool[/type]
	[en]Specifies whether the user should be accepted (true) or cancelled (false).[/en]
	[de]Gibt an ob die Registrierung des Benutzers akzeptiert (true) oder storniert (false) werden soll.[/de]
	*/
	public function acceptUserByEmail($_sEmail, $_bAccept = NULL)
	{
		$_bAccept = $this->getRealParameter(array('oParameters' => $_sEmail, 'sName' => 'bAccept', 'xParameter' => $_bAccept));
		$_sEmail = $this->getRealParameter(array('oParameters' => $_sEmail, 'sName' => 'sEmail', 'xParameter' => $_sEmail));
		
		if ($_bAccept === NULL) {$_bAccept = true;}

		$this->checkDatabaseConnection();
		
		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'user', 
					'asColumns' => array('UserID'), 
                    'xWhere' => array('Email' => array('LIKE' => $this->realEscapeDatabaseString(array('xString' => trim($_sEmail))))),
					'iStart' => NULL, 
					'iCount' => 1,
					'sOrderBy' => NULL, 
					'bOrderReverse' => NULL
				)
			)
		)
		{
			if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
			{
				if ($_axUser['UserID'] > 0) {return $this->acceptUserByID(array('iUserID' => $_axUser['UserID'], 'bAccept' => $_bAccept));}
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Returns whether a user name is not allowed.[/en]
	[de]Gibt zurück, ob ein Benutzername nicht erlaubt ist.[/de]
	
	@return bIsDisallowed [type]bool[/type]
	[en]Returns a boolean whether a user name is not allowed.[/en]
	[de]Gibt einen Boolean zurück, ob ein Benutzername nicht erlaubt ist.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The username that must be checked.[/en]
	[de]Der Benutzername der zu prüfen ist.[/de]
	*/
	public function isUsernameDisallowed($_sUsername)
	{
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sUsername', 'xParameter' => $_sUsername));

		$this->checkDatabaseConnection();
		
		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'username_disallowed', 
					'asColumns' => array('DisallowedID'), 
                    'xWhere' => array('Username' => array('LIKE' => $this->realEscapeDatabaseString(array('xString' => trim($_sUsername))))),
					'iStart' => NULL, 
					'iCount' => 1,
					'sOrderBy' => NULL, 
					'bOrderReverse' => NULL
				)
			)
		)
		{
			if ($_axDisallowed = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
			{
				if ($_axDisallowed['DisallowedID'] > 0) {return true;}
			}	
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Checks whether the username or the e-mail address has already been used.[/en]
	[de]Prüft ob der Benutzername oder die E-Mail-Adresse bereits verwendet wurde.[/de]
	
	@return bUserExists [type]bool[/type]
	[en]Returns a boolean whether the username or the e-mail address has already been used.[/en]
	[de]Gibt einen Boolean zurück, ob der Benutzername oder die E-Mail-Adresse bereits verwendet wurde.[/de]
	
	@param sUsername [type]string[/type]
	[en]The username that must be checked.[/en]
	[de]Der Benutzername, der zu prüfen ist.[/de]
	
	@param sEmail [type]string[/type]
	[en]The email adress that must be checked.[/en]
	[de]Die E-Mail-Adresse, die zu prüfen ist.[/de]
	
	@param iIgnoreUserID [type]int[/type]
	[en]The user ID of a user that is to be ignored. Is actually used in order to exclude the user that is currently being processed.[/en]
	[de]Die BenutzerID von einem Benutzer, der zu ignorieren ist. Wird eigentlich benutzt um den Benutzer auszuschließen, der gerade bearbeitet wird.[/de]
	*/
	public function userExists($_sUsername = NULL, $_sEmail = NULL, $_iIgnoreUserID = NULL)
	{
		$_sEmail = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sEmail', 'xParameter' => $_sEmail));
		$_iIgnoreUserID = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'iIgnoreUserID', 'xParameter' => $_iIgnoreUserID));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sUsername', 'xParameter' => $_sUsername));

		if (($_sUsername != NULL) || ($_sEmail != NULL))
		{
			$this->checkDatabaseConnection();

            $_sUsername = $this->realEscapeDatabaseString(array('xString' => trim($_sUsername)));
            $_sEmail = $this->realEscapeDatabaseString(array('xString' => trim($_sEmail)));

            $_axWhere = array();
            if (($_sUsername != '') && ($_sEmail != ''))
            {
                $_axWhere = array(
                    'OR' => array(
                        array('Username' => array('LIKE' => $_sUsername)),
                        array('Email' => array('LIKE' => $_sEmail))
                    )
                );
            }
            else if ($_sUsername != '')
            {
                $_axWhere['Username'] = array('LIKE' => $_sUsername);
            }
            else if ($_sEmail != '')
            {
                $_axWhere['Email'] = array('LIKE' => $_sEmail);
            }

            if ($_iIgnoreUserID != NULL)
            {
                $_axWhere['UserID'] = array('!=' => $_iIgnoreUserID);
            }

			if
			(
				$_oResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'user', 
						'asColumns' => array('UserID'), 
						'xWhere' => $_axWhere,
						'iStart' => NULL, 
						'iCount' => 1,
						'sOrderBy' => NULL, 
						'bOrderReverse' => NULL
					)
				)
			)
			{
				if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
				{
					if (!empty($_axUser['UserID'])) {return $_axUser['UserID'];}
				}
			}
		}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Saves the currently logged in user with the current data.[/en]
	[de]Speichert den aktuell eingeloggten Benutzer mit den aktuellen Daten.[/de]
	
	@return iUserID [type]int[/type]
	[en]Returns the user ID.[/en]
	[de]Gibt die Benutzer ID zurück.[/de]
	
	@param sOldPassword [needed][type]string[/type]
	[en]The old password of the user, if it is needed.[/en]
	[de]Das alte Passwort des Benutzers, wenn er benötigt wird.[/de]
	*/
	public function saveCurrentAccount($_sOldPassword)
	{
		$_sOldPassword = $this->getRealParameter(array('oParameters' => $_sOldPassword, 'sName' => 'sOldPassword', 'xParameter' => $_sOldPassword));

		return $this->saveAccount(
			array(
				'iUserID' => $this->axLoginData['UserID'], 
				'iUserType' => $this->axLoginData['UserType'], 
				'sGender' => $this->axLoginData['Gender'], 
				'sFirstName' => $this->axLoginData['FirstName'], 
				'sLastName' => $this->axLoginData['LastName'], 
				'sStreet' => $this->axLoginData['Street'], 
				'sZipCode' => $this->axLoginData['ZipCode'], 
				'sLocale' => $this->axLoginData['Locale'], 
				'sCountry' => $this->axLoginData['Country'], 
				'sUsername' => $this->axLoginData['Username'], 
				'sEmail' => $this->axLoginData['Email'], 
				'sPassword' => $this->axLoginData['Password'], 
				'sOldPassword' => $_sOldPassword,
				'sLanguage' => $this->axLoginData['Language']
			)
		);
	}
	/* @end method */

	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Saves a user account in the database.[/en]
	[de]Speichert einen Benutzer-Account in der Datenbank.[/de]
	
	@return iUserID [type]int[/type]
	[en]Returns the user ID on success.[/en]
	[de]Gibt bei Erfolg die Benutzer ID zurück.[/de]
	
	@param iUserID [needed][type]int[/type]
	[en]The user ID if the user already exists.[/en]
	[de]Die Benutzer ID, wenn der Benutzer bereits vorhanden ist.[/de]
	
	@param iUserType [needed][type]int[/type]
	[en]
		The type of the user.
		The following user types are possible:
		%LoginUserTypes%
	[/en]
	[de]
		Der Typ des Benutzers.
		Folgende Benutzertypen sind möglich:
		%LoginUserTypes%
	[/de]
	
	@param sGender [needed][type]string[/type]
	[en]The gender of the user.[/en]
	[de]Das Geschlecht des Benutzers.[/de]
	
	@param sFirstName [needed][type]string[/type]
	[en]The first name of the user.[/en]
	[de]Der Vorname des Benutzers.[/de]
	
	@param sLastName [needed][type]string[/type]
	[en]The last name of the user.[/en]
	[de]Der Nachname des Benutzers.[/de]
	
	@param sStreet [needed][type]string[/type]
	[en]The street of the user.[/en]
	[de]Die Straße des Benutzers.[/de]
	
	@param sZipCode [needed][type]string[/type]
	[en]The zip code of the user.[/en]
	[de]Der Postleitzahl des Benutzers.[/de]
	
	@param sLocale [needed][type]string[/type]
	[en]The locale of the user.[/en]
	[de]Der Ort des Benutzers.[/de]
	
	@param sCountry [needed][type]string[/type]
	[en]The Country of the user.[/en]
	[de]Das Land des Benutzers.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The username of the user.[/en]
	[de]Der Benutzername des Benutzers.[/de]
	
	@param sEmail [needed][type]string[/type]
	[en]The email adress of the user.[/en]
	[de]Der E-Mail-Adresse des Benutzers.[/de]
	
	@param sPassword [needed][type]string[/type]
	[en]The password of the user.[/en]
	[de]Der Passwort des Benutzers.[/de]
	
	@param sOldPassword [needed][type]string[/type]
	[en]The old password, if one is already present.[/en]
	[de]Das alte Passwort des Benutzers, falls bereits eins vorhanden ist.[/de]
	
	@param sLanguage [needed][type]string[/type]
	[en]The language of the user.[/en]
	[de]Die Sprache des Benutzers.[/de]
	*/
	public function saveAccount(
		$_iUserID, 
		$_iUserType = NULL, 
		$_sGender = NULL, 
		$_sFirstName = NULL, 
		$_sLastName = NULL, 
		$_sStreet = NULL, 
		$_sZipCode = NULL, 
		$_sLocale = NULL, 
		$_sCountry = NULL, 
		$_sUsername = NULL, 
		$_sEmail = NULL, 
		$_sPassword = NULL, 
		$_sOldPassword = NULL, 
		$_sLanguage = NULL)
	{
		$_iUserType = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserType', 'xParameter' => $_iUserType));
		$_sGender = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sGender', 'xParameter' => $_sGender));
		$_sFirstName = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sFirstName', 'xParameter' => $_sFirstName));
		$_sLastName = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sLastName', 'xParameter' => $_sLastName));
		$_sStreet = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sStreet', 'xParameter' => $_sStreet));
		$_sZipCode = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sZipCode', 'xParameter' => $_sZipCode));
		$_sLocale = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sLocale', 'xParameter' => $_sLocale));
		$_sCountry = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sCountry', 'xParameter' => $_sCountry));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		$_sEmail = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sEmail', 'xParameter' => $_sEmail));
		$_sPassword = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_sOldPassword = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sOldPassword', 'xParameter' => $_sOldPassword));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));

		if ((($_iUserType === NULL) || ($_iUserType === PG_LOGIN_USERTYPE_GUEST))
		&& (($_iUserID === NULL) || (empty($_iUserID))))
		{
			$_iUserType = $this->iDefaultUserType;
		}
		
		$_bSetRights = false;
		
		$_sGender = trim($_sGender);
		$_sFirstName = trim($_sFirstName);
		$_sLastName = trim($_sLastName);
		$_sStreet = trim($_sStreet);
		$_sZipCode = trim($_sZipCode);
		$_sLocale = trim($_sLocale);
		$_sCountry = trim($_sCountry);
		$_sUsername = trim($_sUsername);
		$_sEmail = trim($_sEmail);
		$_sPassword = trim($_sPassword);
		$_sLanguage = trim($_sLanguage);

		$this->checkDatabaseConnection();
		
		$_bUsernameDisallowed = $this->isUsernameDisallowed($_sUsername);
		
		if (!empty($_iUserID))
		{
			$_asColumns = array('UserType', 'Gender', 'FirstName', 'LastName', 'Username', 'Email', 'Password', 'Language', 'Street', 'ZipCode', 'Locale', 'Country');

			if
			(
				$_oResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'user', 
						'asColumns' => $_asColumns, 
						'xWhere' => array('UserID' => $_iUserID),
						'iStart' => NULL, 
						'iCount' => 1,
						'sOrderBy' => NULL, 
						'bOrderReverse' => NULL
					)
				)
			)
			{
				if ($_axUserData = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
				{
					if ($_sOldPassword != NULL) {$_sOldPassword = $this->realEscapeDatabaseString(array('xString' => $_sOldPassword));}
					if
					(
						(
							(
								$_axUserData['Password'] == $this->buildPasswordCryption(
									array(
										'sPassword' => $_sOldPassword, 
										'sUsername' => $this->realEscapeDatabaseString(array('xString' => $_axUserData['Username']))
									)
								)
							)
							&& ($this->axLoginData['UserID'] == $_iUserID)
							&& ((empty($_iUserType)) || ($_iUserType == NULL))
						)
						|| ($this->isUserType(array('iType' => PG_LOGIN_USERTYPE_ADMIN | PG_LOGIN_USERTYPE_SUPERADMIN)))
					)
					{
						$_bSetRights = true;
					}

					if ($_sFirstName == NULL)		{$_sFirstName = $_axUserData['FirstName'];}
					if ($_sLastName == NULL)		{$_sLastName = $_axUserData['LastName'];}
					if ($_sStreet == NULL)			{$_sStreet = $_axUserData['Street'];}
					if ($_sZipCode == NULL)			{$_sZipCode = $_axUserData['ZipCode'];}
					if ($_sLocale == NULL)			{$_sLocale = $_axUserData['Locale'];}
					if ($_sCountry == NULL)			{$_sCountry = $_axUserData['Country'];}
					if (($_iUserType < 1)			|| ($_iUserType == NULL))	{$_iUserType = $_axUserData['UserType'];}
					if ((trim($_sGender) == "")		|| ($_sGender == NULL))		{$_sGender = $_axUserData['Gender'];}
					if ((trim($_sUsername) == "")	|| ($_sUsername == NULL))	{$_sUsername = $_axUserData['Username'];}
					if ((trim($_sEmail) == "")		|| ($_sEmail == NULL))		{$_sEmail = $_axUserData['Email'];}
					if ((trim($_sLanguage) == "")	|| ($_sLanguage == NULL))	{$_sLanguage = $_axUserData['Language'];}
				} // if _axUser
			} // if _oResult
		}
		else if (($_sUsername != '') && (($_sEmail != '') || ($this->bRequireEmail == false)))
		{
			$_asColumns = array('UserID');
			/*$_sWhere = '';
			$_sWhere .= 'Username LIKE "'.$this->realEscapeDatabaseString(array('xString' => $_sUsername)).'"';
			if ($_sEmail != '') {$_sWhere .= ' OR Email LIKE "'.$this->realEscapeDatabaseString(array('xString' => $_sEmail)).'"';}
            */

            $_axWhere = array();
            if ($_sEmail != '')
            {
                $_axWhere = array(
                    'OR' => array(
                        array('Username' => array('LIKE' => $this->realEscapeDatabaseString(array('xString' => $_sUsername)))),
                        array('Email' => array('LIKE' => $this->realEscapeDatabaseString(array('xString' => $_sEmail))))
                    )
                );
            }
            else
            {
                $_axWhere = array('Username' => array('LIKE' => $this->realEscapeDatabaseString(array('xString' => $_sUsername))));
            }

			if
			(
				$this->getDatasetsRowCount(
					$this->selectDatasets(
						array(
							'sTable' => $this->getDatabaseTablePrefix().'user', 
							'asColumns' => $_asColumns, 
							'xWhere' => $_axWhere,
							'iStart' => NULL, 
							'iCount' => 1,
							'sOrderBy' => NULL, 
							'bOrderReverse' => NULL
						)
					)
				) < 1
			)
			{
				$_bSetRights = true;
				$_iUserID = -1;
			}
		}

		if (($_bSetRights == true) && ($_sUsername != '') && (($_sEmail != '') || ($this->bRequireEmail == false)) && ($_bUsernameDisallowed == false))
		{
			$_iNowTimeStamp = time();
			$_sNewPassword = '';
			if (($_sPassword != '') && ($_sUsername != ''))
			{
				$_sNewPassword = $this->buildPasswordCryption(
					array(
						'sPassword' => $this->realEscapeDatabaseString(array('xString' => $_sPassword)), 
						'sUsername' => $this->realEscapeDatabaseString(array('xString' => $_sUsername))
					)
				);
			}
			
			$_sAccess = '';
			if (($_iUserType > 0) && ($_sUsername != ''))
			{
				$_sAccess = $this->buildAccessKey(array('iUserType' => $_iUserType, 'sUsername' => $_sUsername));
			}
			
			$_axColumnsAndValues = array();
			$_axColumnsAndValues['Gender'] = $_sGender;
			$_axColumnsAndValues['FirstName'] = $_sFirstName;
			$_axColumnsAndValues['LastName'] = $_sLastName;
			$_axColumnsAndValues['Street'] = $_sStreet;
			$_axColumnsAndValues['ZipCode'] = $_sZipCode;
			$_axColumnsAndValues['Locale'] = $_sLocale;
			$_axColumnsAndValues['Country'] = $_sCountry;
			$_axColumnsAndValues['Username'] = $_sUsername;
			$_axColumnsAndValues['Email'] = $_sEmail;
			$_axColumnsAndValues['Language'] = $_sLanguage;
			if (($_sAccess != '') && ($_iUserType > 0))
			{
				$_axColumnsAndValues['UserType'] = $_iUserType;
				$_axColumnsAndValues['Access'] = $_sAccess;
			}
			if ($_sNewPassword != '') {$_axColumnsAndValues['Password'] = $_sNewPassword;}
			
			$_axColumnsAndValuesOnInsert = array();
			$_axColumnsAndValuesOnInsert['CreateTimeStamp'] = $_iNowTimeStamp;
			
			$_axColumnsAndValuesOnUpdate = array();
			$_axColumnsAndValuesOnUpdate['ChangeTimeStamp'] = $_iNowTimeStamp;

			$_iUserID = $this->saveDataset(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'user', 
					'sIDColumn' => 'UserID', 
					'xIDValue' => $_iUserID,
                    'sAutoIDColumn' => 'UserID',
					'axColumnsAndValues' => $_axColumnsAndValues, 
					'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 
					'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate,
                    'xWhere' => NULL,
					'bAllowAnonymInsert' => true,
					'sEngine' => NULL
				)
			);
		}

		return $_iUserID;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Loads a user based on the UserID from the database.[/en]
	[de]Lädt einen Benutzer anhand der BenutzerID aus der Datenbank.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns whether the user was successfully loaded.[/en]
	[de]Gibt zurück ob der Benutzer erfolgreich geladen wurde.[/de]
	
	@param iUserID [needed][type]int[/type]
	[en]The user ID of the user to load.[/en]
	[de]Die Benutzer ID vom Benutzer der geladen werden soll.[/de]
	*/
	private function loadUserDataByID($_iUserID)
	{
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));

        if ($_iUserID === NULL) {$_iUserID = 0;}

		if ($_iUserID != 0)
		{
			$_asColumns = array(
				'UserID', 'Username', 'Email', 'Gender', 
				'FirstName', 'LastName', 'Access', 'Language', 
				'Street', 'ZipCode', 'Locale', 'Country', 
				PG_LOGIN_TIMESTAMP_PREFIX.'LoginTimeStamp'
			);

            if ($this->sAdditionalSelect == '*')
            {
                $_asColumns = NULL;
            }
			else if ($this->sAdditionalSelect != '')
			{
				$_asAdditionalSelect = explode(',', $this->sAdditionalSelect);
				for ($i=0; $i<count($_asAdditionalSelect); $i++)
				{
					if (trim($_asAdditionalSelect[$i]) != '') {$_asColumns[] = trim($_asAdditionalSelect[$i]);}
				}
			}
			
			if
			(
				$_oResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'user', 
						'asColumns' => $_asColumns, 
						'xWhere' => array('UserID' => $_iUserID),
						'iStart' => NULL, 
						'iCount' => 1,
						'sOrderBy' => NULL, 
						'bOrderReverse' => NULL
					)
				)
			)
			{
				if ($this->axLoginData = $this->fetchDatabaseArray(array('xResult' => $_oResult, 'sEngine' => NULL)))
				{
					$this->processUserType();
					return true;
				}
			}
  		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Processes a user that was loaded.[/en]
	[de]Verarbeitet einen Benutzer der geladen wurde.[/de]
	*/
	private function processUserType()
	{
		if (!empty($this->axLoginData['UserID']))
		{
			if ($this->axLoginData['Access'] == $this->buildAccessKey(array('iUserType' => PG_LOGIN_USERTYPE_SUPERADMIN, 'sUsername' => $this->axLoginData['Username']))) 		{$this->setUserType(array('iType' => PG_LOGIN_USERTYPE_SUPERADMIN));}
			else if ($this->axLoginData['Access'] == $this->buildAccessKey(array('iUserType' => PG_LOGIN_USERTYPE_ADMIN, 'sUsername' => $this->axLoginData['Username']))) 		{$this->setUserType(array('iType' => PG_LOGIN_USERTYPE_ADMIN));}
			else if ($this->axLoginData['Access'] == $this->buildAccessKey(array('iUserType' => PG_LOGIN_USERTYPE_MODERATOR, 'sUsername' => $this->axLoginData['Username'])))	{$this->setUserType(array('iType' => PG_LOGIN_USERTYPE_MODERATOR));}
			else if ($this->axLoginData['Access'] == $this->buildAccessKey(array('iUserType' => PG_LOGIN_USERTYPE_USER, 'sUsername' => $this->axLoginData['Username'])))		{$this->setUserType(array('iType' => PG_LOGIN_USERTYPE_USER));}
		}
	}
	/* @end method */

    /*
    @start method

    @group Login

    @return bSuccess [type]bool[/type]
    [en]...[/en]
    */
    public function isLoginSuccess()
    {
        return $this->bLoginSuccess;
    }
    /* @end method */

	/*
	@start method
	
	@group Login
	
	@description
	[en]Returns whether a login attempt failed.[/en]
	[de]Gibt zurück ob ein Login-Versuch fehlgeschlagen ist.[/de]
	
	@return bLoginFailed [type]bool[/type]
	[en]Returns a boolean whether a login attempt failed.[/en]
	[de]Gibt einen Boolean zurück, ob ein Login-Versuch fehlgeschlagen ist.[/de]
	*/
	public function isLoginFailed() {return $this->bLoginFailed;}
	/* @end method */

    /*
    @start method

    @group Login

    @return bSuccess [type]bool[/type]
    [en]...[/en]
    */
    public function isLogoutSuccess()
    {
        return $this->bLogoutSuccess;
    }
    /* @end method */

	/*
	@start method
	
	@group Login
	
	@description
	[en]Checks if a user attempts to log in and executes the login.[/en]
	[de]Prüft ob ein Benutzer versucht sich anzumelden und führt den Login aus.[/de]
	
	@return bSessionWasUsed [type]bool[/type]
	[en]Returns whether a session is created for the login.[/en]
	[de]Gibt zurück ob eine Session für den Login erstellt wurde.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The username for the login.[/en]
	[de]Der Benutzername für den Login.[/de]
	
	@param sPassword [needed][type]string[/type]
	[en]The password for the login.[/en]
	[de]Das Passwort für den Login.[/de]
	*/
	public function checkForLogIn($_sUsername, $_sPassword = NULL)
	{
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		return $this->setCookie(array('sUsername' => $_sUsername, 'sPassword' => $_sPassword));
	}
	/* @end method */

    /*
    @start method

    @param sAction [needed][type]string[/type]
    [en]...[/en]

    @param sStatus [needed][type]string[/type]
    [en]...[/en]

    @param iTimeStamp [type]int[/type]
    [en]...[/en]

    @param xUserID [type]mixed[/type]
    [en]...[/en]
    */
    public function logUserAction($_sAction, $_sStatus = NULL, $_xData = NULL, $_iTimeStamp = NULL, $_xUserID = NULL)
    {
        global $oPGUserActionLog;

        $_sStatus = $this->getRealParameter(array('oParameters' => $_sAction, 'sName' => 'sStatus', 'xParameter' => $_sStatus));
        $_xData = $this->getRealParameter(array('oParameters' => $_sAction, 'sName' => 'xData', 'xParameter' => $_xData));
        $_iTimeStamp = $this->getRealParameter(array('oParameters' => $_sAction, 'sName' => 'iTimeStamp', 'xParameter' => $_iTimeStamp));
        $_xUserID = $this->getRealParameter(array('oParameters' => $_sAction, 'sName' => 'xUserID', 'xParameter' => $_xUserID));
        $_sAction = $this->getRealParameter(array('oParameters' => $_sAction, 'sName' => 'sAction', 'xParameter' => $_sAction));

        if ($_iTimeStamp === NULL) {$_iTimeStamp = time();}
        if ($_xUserID === NULL) {if (!empty($this->axLoginData['UserID'])) {$_xUserID = $this->axLoginData['UserID'];}}

        if (($this->bActionLog == true) && (!empty($oPGUserActionLog)))
        {
            $oPGUserActionLog->saveUserAction(array('iUserID' => $_xUserID, 'iTimeStamp' => $_iTimeStamp, 'sAction' => $_sAction, 'sStatus' => $_sStatus, 'xData' => $_xData));
        }
    }
	/* @end method */

	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Checks if a user attempts to log in and executes the login.[/en]
	[de]Prüft ob ein Benutzer versucht sich anzumelden und führt den Login aus.[/de]
	
	@retrun bSessionWasUsed [type]bool[/type]
	[en]Returns whether a session is created for the login.[/en]
	[de]Gibt zurück ob eine Session für den Login erstellt wurde.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The username for the login.[/en]
	[de]Der Benutzername für den Login.[/de]
	
	@param sPassword [needed][type]string[/type]
	[en]The password for the login.[/en]
	[de]Das Passwort für den Login.[/de]
	*/
	public function setCookie($_sUsername, $_sPassword = NULL)
	{
		global $_SESSION, $oPGCryption, $oPGSessionVars;

		$_sPassword = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		
		// $_iSessionUsed = 0;
		if (($_sUsername != '') && ($_sPassword != ''))
		{
			$this->bLoginFailed = true;
			
			$this->checkDatabaseConnection();

			$_sUsername = $this->realEscapeDatabaseString(array('xString' => $_sUsername, 'sEngine' => NULL));
			$_sPassword = $this->realEscapeDatabaseString(array('xString' => $_sPassword, 'sEngine' => NULL));
		
			sleep($this->iLoginRelogWaittime); // prevent fast relogin
			
			if (strripos($_sUsername, '@') !== false) // E-Mail
			{
				if
				(
					$_oResult = $this->selectDatasets(
						array(
							'sTable' => $this->getDatabaseTablePrefix().'user', 
							'asColumns' => array('Username'), 
							'xWhere' => array(
                                'AND' => array(
                                    array('Email' => array('LIKE' => $_sUsername)),
                                    array('Email' => array('!=' => ''))
                                )
                            ),
							'iStart' => NULL, 
							'iCount' => 1,
							'sOrderBy' => NULL, 
							'bOrderReverse' => NULL
						)
					)
				)
				{
					if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult, 'sEngine' => NULL)))
					{
						if ($_axUser['Username'] != '') {$_sUsername = $_axUser['Username'];}
					} // if _axUser
				} // if _oResult
			}

			$_sNewPassword = $this->buildPasswordCryption(array('sPassword' => $this->realEscapeDatabaseString(array('xString' => $_sPassword)), 'sUsername' => $this->realEscapeDatabaseString(array('xString' => $_sUsername))));

			if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'Search for User: '.$_sUsername.' with Password '.$_sPassword.' ['.$_sNewPassword.']'));}
			
			$_asColumns = array(
				'UserID', 'Username', 'Email', 'Gender', 'Accepted',
				'FirstName', 'LastName', 'Access', 'Language', 
				'Street', 'ZipCode', 'Locale', 'Country', 'ReloginPassword',
				PG_LOGIN_TIMESTAMP_PREFIX.'LoginTimeStamp'
			);

            if ($this->sAdditionalSelect == '*')
            {
                $_asColumns = NULL;
            }
			else if ($this->sAdditionalSelect != '')
			{
				$_asAdditionalSelect = explode(',', $this->sAdditionalSelect);
				for ($i=0; $i<count($_asAdditionalSelect); $i++)
				{
					if (trim($_asAdditionalSelect[$i]) != '') {$_asColumns[] = trim($_asAdditionalSelect[$i]);}
				}
			}
			
            $_axWhere = array(
                'Password' => $_sNewPassword,
                'Username' => array('LIKE' => $_sUsername),
                'Banned' => array('!=' => 1)
            );

			if
			(
				$_oResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'user', 
						'asColumns' => $_asColumns, 
						'xWhere' => $_axWhere,
						'iStart' => NULL, 
						'iCount' => 1, 
						'sOrderBy' => NULL, 
						'bOrderReverse' => NULL
					)
				)
			)
			{
				if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => '<b>Result [Rows='.$this->getDatasetsRowCount(array('xResult' => $_oResult)).']: '.$_oResult.'</b>'));}
				if ($this->axLoginData = $this->fetchDatabaseArray(array('xResult' => $_oResult, 'sEngine' => NULL)))
				{
                    $this->bAccountNotAccepted = true;
                    if (!empty($this->axLoginData['Accepted'])) {if ($this->axLoginData['Accepted'] == 1) {$this->bAccountNotAccepted = false;}}
                    if ($this->bAccountNotAccepted == true)
                    {
                        $this->bLoginSuccess = false;
                        $this->bLogoutSuccess = false;
                        $this->iUserType = PG_LOGIN_USERTYPE_GUEST;
                        $this->logUserAction(
                            array(
                                'sAction' => 'login error',
                                'sStatus' => 'user not accepted'
                            )
                        );
                        return $this->bWasSessionUsed;
                    }

					if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'test: <pre>'.print_r($this->axLoginData, true).'</pre>'));}
					if (($this->axLoginData['Username'] != '') && ($this->axLoginData['UserID'] != ''))
					{
						if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'User found: '.$this->axLoginData['Username'].' with UserID '.$this->axLoginData['UserID']));}
						
						$_bNewReloginPassword = false;
						if (($this->bMultiLogin == false) || (empty($this->axLoginData['ReloginPassword'])))
						{
							$_sReloginPassword = $this->buildRandomPassword(array('iLength' => 16, 'sKey' => $this->sSecretKey1, 'sType' => PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_SIMPLE));
							$_bNewReloginPassword = true;
						}
						else if (!empty($this->axLoginData['ReloginPassword'])) {$_sReloginPassword = $this->axLoginData['ReloginPassword'];}
						
						$_temp2 = $_sReloginPassword;
						
						if (isset($oPGCryption)) {$_temp2 = $oPGCryption->encrypt($_temp2, $_sSecretKey = $this->sSecretKey5);}
						$_temp2 = base64_encode($_temp2);
					
						$_iLoginTimeStamp = time();

                        if ($this->bCookieSessions == true)
                        {
                            if ($this->bSessionAutoOpen == true)
                            {
                                $oPGSessionVars->setName(array('sName' => $this->sCookieName));
                                $oPGSessionVars->setLifeTime(array('iSeconds' => $this->iCookieTime));
                                $oPGSessionVars->setPath(array('sPath' => $this->sCookiePath));
                                $oPGSessionVars->setDomain(array('sDomain' => $this->sCookieDomain));
                                $oPGSessionVars->useSecure(array('bUse' => $this->bCookieSecure));
                                $oPGSessionVars->open();
                            }
                            $oPGSessionVars->setString(array('sName' => 'LogID', 'sValue' => $_temp2.";**;".$_iLoginTimeStamp));
                            if ($this->bSessionAutoClose == true) {$oPGSessionVars->close();}
                        }
                        else
                        {
                            if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'setcookie('.$this->sCookieName.', ***, '.$this->iCookieTime.', '.$this->sCookiePath.', '.$this->sCookieDomain.', '.$this->bCookieSecure.');'));}
                            setcookie($this->sCookieName, $_temp2.";**;".$_iLoginTimeStamp, $this->iCookieTime, $this->sCookiePath, $this->sCookieDomain, $this->bCookieSecure);
                        }

						$this->bWasSessionUsed = true;
						$this->bLoginFailed = false;

                        $_axColumnsAndValues = array();
						$_axColumnsAndValues[PG_LOGIN_TIMESTAMP_PREFIX.'LoginTimeStamp'] = $_iLoginTimeStamp;
						if ($_bNewReloginPassword == true) {$_axColumnsAndValues['ReloginPassword'] = utf8_encode($_sReloginPassword);}
						
						$this->updateDatasets(
							array(
								'sTable' => $this->getDatabaseTablePrefix().'user', 
								'sIDColumn' => 'UserID', 
								'xIDValue' => $this->axLoginData["UserID"], 
								'axColumnsAndValues' => $_axColumnsAndValues, 
								'xWhere' => NULL,
								'bStripSlashes' => NULL, 
								'bAllowAnonymUpdate' => true,
								'sEngine' => NULL
							)
						);

                        $this->bLoginSuccess = true;
                        $this->logUserAction(
                            array(
                                'sAction' => 'login',
                                'sStatus' => 'ok',
                                'iTimeStamp' => $_iLoginTimeStamp
                            )
                        );
					}
					else 
					{
						if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'Nothing found!'));}
						if (isset($oPGRandom))
						{
							$oPGRandom->init();
							sleep($oPGRandom->build(array('iMin' => $this->iLoginFailedMinWaittime, 'iMax' => $this->iLoginFailedMaxWaittime))); // advanced wait for failed login
						}
						else {sleep($this->iLoginFailedMinWaittime);} // default wait for failed to login
					}
				} // if axLoginData
			} // if _oResult
		}
		
		return $this->bWasSessionUsed;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Returns the content of the login cookie or session.[/en]
	[de]Gibt den Inhalt des Login Cookies bzw. der Session zurück.[/de]
	
	@return axCookieData [type]mixed[][/type]
	[en]The content of the cookie or session.[/en]
	[de]Der Inhalt des Cookies bzw. der Session.[/de]
	
	@param xWasSessionUsed [type]mixed[/type]
	[en]Specifies whether a session was used. Can be a boolean (true or false) or an integer (1 or 0).[/en]
	[de]Gibt an ob eine Session verwendet wurde. Kann ein Boolean (true oder false) oder ein Integer (1 oder 0) sein.[/de]
	*/
	public function getCookie($_xWasSessionUsed = NULL)
	{
		global $_SESSION, $_COOKIE, $oPGCryption, $oPGSessionVars;

		$_xWasSessionUsed = $this->getRealParameter(array('oParameters' => $_xWasSessionUsed, 'sName' => 'xWasSessionUsed', 'xParameter' => $_xWasSessionUsed));
		
		if ($_xWasSessionUsed == NULL) {$_xWasSessionUsed = $this->bWasSessionUsed;}
		if ($_xWasSessionUsed == 1) {$_xWasSessionUsed = true;}
        if (($this->bLoginFailed == true) || ($this->bAccountNotAccepted == true)) {return false;}

        $_bDestroySession = false;
		$_axCookieData = NULL;
        // if (isset($_COOKIE[$this->sCookieName]))
        if ($this->bCookieSessions == true)
        {
            if ($this->bSessionAutoOpen == true)
            {
                $oPGSessionVars->setName(array('sName' => $this->sCookieName));
                $oPGSessionVars->setLifeTime(array('iSeconds' => $this->iCookieTime));
                $oPGSessionVars->setPath(array('sPath' => $this->sCookiePath));
                $oPGSessionVars->setDomain(array('sDomain' => $this->sCookieDomain));
                $oPGSessionVars->useSecure(array('bUse' => $this->bCookieSecure));
                $oPGSessionVars->open();
            }
            $_axCookieData = explode(';**;', $oPGSessionVars->getString(array('sName' => 'LogID')));
            if ($this->bSessionAutoClose == true) {$oPGSessionVars->close();}
            $this->logUserAction(
                array(
                    'sAction' => 'login get cookie',
                    'sStatus' => 'cookiedata',
                    'xData' => $_axCookieData
                )
            );
        }
        else
        {
			if ($_xWasSessionUsed == true)
			{
                $_axCookieData = explode(';**;', $oPGSessionVars->getString(array('sName' => 'LogID')));
                $_bDestroySession = true;
			}
			else {$_axCookieData = explode(";**;", $_COOKIE[$this->sCookieName]);}
            $this->logUserAction(
                array(
                    'sAction' => 'login get cookie',
                    'sStatus' => 'cookiedata',
                    'xData' => $_axCookieData
                )
            );
		}

        if (($this->bSessionAutoClose == true) || ($_bDestroySession == true)) {$oPGSessionVars->close(array('bDestroy' => $_bDestroySession));}
		
		if (count($_axCookieData) > 0)
		{
			$_sReloginPassword = base64_decode($_axCookieData[0]);
			if (isset($oPGCryption)) {$_sReloginPassword = $oPGCryption->decrypt(array('sString' => $_sReloginPassword, 'sKey' => $this->sSecretKey5));}
			if (isset($_sReloginPassword))
			{
				$this->checkDatabaseConnection();
				
				$_sReloginPassword = $this->realEscapeDatabaseString(array('xString' => trim($_sReloginPassword), 'sEngine' => NULL));
			
				$_asColumns = array(
					'UserID', 'Username', 'Email', 'Gender', 'SimulateUserID',
					'FirstName', 'LastName', 'Access', 'Language', 
					'Street', 'ZipCode', 'Locale', 'Country',
					PG_LOGIN_TIMESTAMP_PREFIX.'LoginTimeStamp'
				);

                if ($this->sAdditionalSelect == '*')
                {
                    $_asColumns = NULL;
                }
				else if ($this->sAdditionalSelect != '')
				{
					$_asAdditionalSelect = explode(',', $this->sAdditionalSelect);
					for ($i=0; $i<count($_asAdditionalSelect); $i++)
					{
						if (trim($_asAdditionalSelect[$i]) != '') {$_asColumns[] = trim($_asAdditionalSelect[$i]);}
					}
				}

                $_axWhere = array(
                    'ReloginPassword' => utf8_encode($_sReloginPassword)
                );

				if
				(
					$_oResult = $this->selectDatasets(
						array(
							'sTable' => $this->getDatabaseTablePrefix().'user', 
							'asColumns' => $_asColumns, 
							'xWhere' => $_axWhere,
							'iStart' => NULL, 
							'iCount' => 1,
							'sOrderBy' => NULL, 
							'bOrderReverse' => NULL
						)
					)
				)
				{
					if ($this->axLoginData = $this->fetchDatabaseArray(array('xResult' => $_oResult, 'sEngine' => NULL)))
					{
						$this->processUserType();
						if ($this->isUserType(array('iType' => PG_LOGIN_USERTYPE_SUPERADMIN))) {$this->loadUserDataByID(array('iUserID' => $this->axLoginData['SimulateUserID']));}
					} // if axLoginData
				} // if _oResult
			}
		}
		return $_axCookieData;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Login
	
	@description
	[en]Checks whether a user wants to log out.[/en]
	[de]Prüft ob sich ein Benutzer abmelden möchte.[/de]
	
	@param xLogout [needed][type]mixed[/type]
	[en]Specifies whether a user wants to log out. Can be a boolean (true or false) or an integer (1 or 0).[/en]
	[de]Gibt an ob sich ein Benutzer abmelden möchte. Kann ein Boolean (true oder false) oder ein Integer (1 oder 0) sein.[/de]
	*/
	public function checkForLogOut($_xLogout)
	{
		$_xLogout = $this->getRealParameter(array('oParameters' => $_xLogout, 'sName' => 'xLogout', 'xParameter' => $_xLogout));
		if (($_xLogout == 1) || ($_xLogout == true))
        {
            $this->delCookie();
            $this->bLogoutSuccess = true;
        }
	}
	/* @end method */
	
	/*
	@start method
	
	@group Cookies
	
	@description
	[en]Deletes the login cookie or the session.[/en]
	[de]Löscht das Login-Cookie oder die Session.[/de]
	*/
	public function delCookie()
	{
		global $_SESSION, $oPGSessionVars;
	
		// $this->axLoginData = array();
        $this->iUserType = PG_LOGIN_USERTYPE_GUEST;

        if ($this->bCookieSessions == false)
        {
    		setcookie($this->sCookieName, '', time()-36000, $this->sCookiePath, $this->sCookieDomain, $this->bCookieSecure);
        }
        else
        {
            $oPGSessionVars->setName(array('sName' => $this->sCookieName));
            $oPGSessionVars->setLifeTime(array('iSeconds' => $this->iCookieTime)); // time()-36000));
            $oPGSessionVars->setPath(array('sPath' => $this->sCookiePath));
            $oPGSessionVars->setDomain(array('sDomain' => $this->sCookieDomain));
            $oPGSessionVars->useSecure(array('bUse' => $this->bCookieSecure));
            $oPGSessionVars->open();
            $oPGSessionVars->destroy();
        }
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]Builds a random password and returns it.[/en]
	[de]Erstellt ein zufälliges Passwort und gibt es zurück.[/de]
	
	@return sPassword [type]string[/type]
	[en]Returns the password.[/en]
	[de]Gibt das Passwort zurück.[/de]
	
	@param iLength [type]int[/type]
	[en]The number of characters that you want the password.[/en]
	[de]Die Anzahl an Zeichen die das Passwort haben soll.[/de]
	
	@param sKey [type]string[/type]
	[en]The secret key for the password.[/en]
	[de]Der Geheimschlüssel für das Passwort.[/de]
	
	@param sType [type]string[/type]
	[en]
		The type of password.
		Possible types are:	
		PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_SERIAL
		PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_SIMPLE
		PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_STRONG
	[/en]
	[de]
		Der Typ des Passworts.
		Mögliche Typen sind:
		PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_SERIAL
		PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_SIMPLE
		PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_STRONG
	[/de]
	*/
	public function buildRandomPassword($_iLength = NULL, $_sKey = NULL, $_sType = NULL)
	{
		$_sKey = $this->getRealParameter(array('oParameters' => $_iLength, 'sName' => 'sKey', 'xParameter' => $_sKey));
		$_sType = $this->getRealParameter(array('oParameters' => $_iLength, 'sName' => 'sType', 'xParameter' => $_sType));
		$_iLength = $this->getRealParameter(array('oParameters' => $_iLength, 'sName' => 'iLength', 'xParameter' => $_iLength));

		if (($_iLength === NULL) || ($_iLength < 6)) {$_iLength = 6;}
		if ($_sKey === NULL) {$_sKey = $this->sSecretKey1;}
		if ($_sType === NULL) {$_sType = PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_SIMPLE;}
		
		$_asReplace = array();
		if ($_sType != PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_STRONG)
		{
			$_asReplace = array("\$","@",".","/","\\","!","�","&","%","=","?","(",")","{","}","[","]","#","'","\"","*","+","~","^","�");
		}
		
		if ($_sType == PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_SERIAL) {$_iSubLength = ceil(($_iLength / 4));}
		else {$_iSubLength = 1;}
		
		$_iCount = 0;
		$_sString = false;
		$_sRandomID = '';
		for ($t=0; $t<$_iSubLength; $t++)
		{
			//generate a random id encrypt it and store it in $rnd_id 
			$_sRandomID = crypt(uniqid(rand(),1).$_sKey);
			
			//to remove any slashes that might have come 
			$_sRandomID = strip_tags(stripslashes($_sRandomID));
			
			//Removing any special chars and reversing the string 
			for ($i=0; $i<count($_asReplace); $i++) {$_sRandomID = str_replace($_asReplace[$i], '', $_sRandomID);}
			$_sRandomID = strrev($_sRandomID);
		
			//Cut the length...
			if ($_sType == PG_LOGIN_BUILD_RANDOM_PASSWORD_TYPE_SERIAL)
			{
				if ($t > 0) {$_sString .= "-";}
				$_sTemp = $_iLength - $_iCount;
				if ($_sTemp >= 4) {$_sRandomID = substr($_sRandomID, 0, 4);}
				else {$_sRandomID = substr($_sRandomID, 0, $_sTemp);}
				$_iCount = $_iCount + 4;
			}
			else {$_sRandomID = substr($_sRandomID, 0, $_iLength);}
			$_sString .= $_sRandomID;
		}
		
		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Builds a security code an returns it.[/en]
	[de]Erstellt einen Sicherheitscode und gibt ihn zurück.[/de]
	
	@return sSecureCode [type]string[/type]
	[en]Returns the security code.[/en]
	[de]Gibt den Sicherheitscode zurück.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The user name for which to create the security code.[/en]
	[de]Der Benutzername für den der Sicherheitscode erstellt werden soll.[/de]
	
	@param sEmail [needed][type]string[/type]
	[en]The email address of the user for which to create the security code.[/en]
	[de]Die E-Mail-Adresse des Benutzers für den der Sicherheitscode erstellt werden soll.[/de]
	*/
	public function buildSecureCode($_sUsername, $_sEmail = NULL)
	{
		$_sEmail = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sEmail', 'xParameter' => $_sEmail));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		return md5($this->sSecretKey1.strtolower($_sUsername).$this->sSecretKey2.strtolower($_sEmail).$this->sSecretKey3);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Builds an access key to make sure that it is really the appropriate user.[/en]
	[de]Erstellt einen Zugriffsschlüssel um sicher zu stellen, dass es sich wirklich um den entsprechenden Benutzer handelt.[/de]
	
	@return sAccessKey [type]string[/type]
	[en]Returns the access key.[/en]
	[de]Gibt den Zugriffsschlüssel zurück.[/de]
	
	@param iUserType [needed][type]int[/type]
	[en]The user type of the user.[/en]
	[de]Der Benutzertyp des Benutzers.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The username of the user.[/en]
	[de]Der Benutzername des Benutzers.[/de]
	*/
	public function buildAccessKey($_iUserType, $_sUsername = NULL)
	{
		$_sUsername = $this->getRealParameter(array('oParameters' => $_iUserType, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		$_iUserType = $this->getRealParameter(array('oParameters' => $_iUserType, 'sName' => 'iUserType', 'xParameter' => $_iUserType));
		return md5(strtolower($_sUsername).'_'.$_iUserType.'_'.strtolower($_sUsername));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Encrypts a password.[/en]
	[de]Verschlüsselt ein Passwort.[/de]
	
	@return sPasswordCryption [type]string[/type]
	[en]Returns the encrypted password.[/en]
	[de]Gibt das verschlüsselte Passwort zurück.[/de]
	
	@param sPassword [needed][type]string[/type]
	[en]The password in plain text.[/en]
	[de]Das Passwort im Klartext.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The user name of the user.[/en]
	[de]Der Benutzername des Benutzers.[/de]
	*/
	public function buildPasswordCryption($_sPassword, $_sUsername = NULL)
	{
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sPassword, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sPassword, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
        if ($this->bUsernameInPasswordCryption == true) {return md5($this->sSecretKey1.$_sPassword.$this->sSecretKey2.strtolower($_sUsername).$this->sSecretKey3);}
		return md5($this->sSecretKey1.$_sPassword.$this->sSecretKey2.'NoUser'.$this->sSecretKey3);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]Builds a form to reset your password.[/en]
	[de]Erstellt ein Formular zum Zurücksetzen des Passworts.[/de]
	
	@return sFormHtml [type]string[/type]
	[en]Returns the form as a string.[/en]
	[de]Gibt das Formular als String zurück.[/de]
	*/
	public function buildPasswordResetForm($_xTemplate = NULL)
    {
        $_xTemplate = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));

        $_sHiddenFields = '';
        $_sHiddenFields .= '<input type="hidden" name="sPGAccount" value="password_reset" />';

        $_sHtml = '';

        if (!empty($_xTemplate))
        {
            $this->addTemplateReplaceVar(array('sVarname' => 'FormUrl', 'sReplace' => $this->getUrl()));
            $this->addTemplateReplaceVar(array('sVarname' => 'FormTarget', 'sReplace' => $this->getUrlTarget()));
            $this->addTemplateReplaceVar(array('sVarname' => 'FormUrlParameters', 'sReplace' => $this->getUrlParametersForm().$_sHiddenFields));

            $this->addTemplateReplaceVar(array('sVarname' => 'FieldNameEmail', 'sReplace' => 'sEmail'));
            $this->addTemplateReplaceVar(array('sVarname' => 'ButtonNameSubmit', 'sReplace' => 'sSubmit'));
            $this->addTemplateReplaceVar(array('sVarname' => 'ButtonTextSubmit', 'sReplace' => 'absenden'));

            $_sHtml .= $this->buildTemplate(
                array(
                    'xTemplate' => $_xTemplate,
                    'bReplaceUrlProtocols' => NULL,
                    'bReplaceBBCode' => NULL,
                    'bReplaceDates' => NULL,
                    'bEncodeMails' => NULL
                )
            );
        }
        else
        {
            $_sHtml .= '<b>Passwort zur&uuml;cksetzen lassen</b><br /><br />';
            $_sHtml .= '<form action="';
            if ($this->isUrlRewrite()) {$_sHtml .= $this->getText(array('sType' => 'RewriteUrlPasswordReset'));}
            else {$_sHtml .= $this->getUrl();}
            $_sHtml .= '" method="post" target="'.$this->getUrlTarget().'" accept-charset="'.$this->sFormCharset.'">';
            $_sHtml .= $this->getUrlParametersForm();
            $_sHtml .= $_sHiddenFields;
                $_sHtml .= '<table align="center">';
                $_sHtml .= '<tr>';
                    $_sHtml .= '<td>E-Mail-Adresse</td>';
                    $_sHtml .= '<td><input type="text" name="sEmail" value="" /></td>';
                $_sHtml .= '</tr>';
                $_sHtml .= '</table>';
                $_sHtml .= '<br />';
                $_sHtml .= '<input type="submit" class="button" name="sSubmit" value="ausf&uuml;hren" />';
            $_sHtml .= '</form>';
        }

		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]Builds the HTML code of the request for resetting the password and sends a confirmation mail.[/en]
	[de]Erstellt den HTML Code der Anfrage für das Zurücksetzen des Passworts und sendet eine Bestätigungsmail.[/de]
	
	@return sPasswordResetHtml [type]string[/type]
	[en]Returns the HTML code as a string.[/en]
	[de]Gibt den HTML Code als String zurück.[/de]
	
	@param sPassword [needed][type]string[/type]
	[en]The new password, if you want a specific password. If no password is specified, the system generates a random password.[/en]
	[de]Das neue Passwort, falls ein bestimmtes Passwort gewünscht wird. Wenn kein neues Passwort angegeben wird, erstellt das System ein zufälliges Passwort.[/de]

	@param sEmail [type]string[/type]
	[en]The email address of the user for the password to be reset.[/en]
	[de]Die E-Mail-Adresse des Benutzers, für den das Passwort zurückgesetzt werden soll.[/de]
	
	@param sUsername [type]string[/type]
	[en]The username of the user for the password to be reset.[/en]
	[de]Der Benutzername des Benutzers, für den das Passwort zurückgesetzt werden soll.[/de]
	*/
	public function buildRequestPasswordReset($_sPassword, $_sEmail = NULL, $_sUsername = NULL)
	{
		$_sEmail = $this->getRealParameter(array('oParameters' => $_sPassword, 'sName' => 'sEmail', 'xParameter' => $_sEmail));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sPassword, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sPassword, 'sName' => 'sPassword', 'xParameter' => $_sPassword));

		if ($_sPassword === NULL) {$_sPassword = '';}
		if ($_sEmail === NULL) {$_sEmail = '';}
		if ($_sUsername === NULL) {$_sUsername = '';}
	
		$_sHtml = '';
		
		$this->checkDatabaseConnection();
		
		$_asColumns = array('UserID', 'Username');
		$_axWhere = NULL;
		if ($_sEmail != '') {$_axWhere = array('Email' => array('LIKE' => $_sEmail));}
		else {$_axWhere = array('Username' => array('LIKE' => $_sUsername));}
		
		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'user', 
					'asColumns' => $_asColumns, 
					'xWhere' => $_axWhere,
					'iStart' => NULL, 
					'iCount' => 1,
					'sOrderBy' => NULL, 
					'bOrderReverse' => NULL
				)
			)
		)
		{
			if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult, 'sEngine' => NULL)))
			{
				if ($_axUser['Username'] != '')
				{
					if ($_sPassword == '') {$_sPassword = $this->buildRandomPassword();}
					$_sNewPassword = $this->buildPasswordCryption(array('sPassword' => $_sPassword, 'sUsername' => $_axUser['Username']));

					$_axColumnsAndValues = array();
					$_axColumnsAndValues['PwdReset'] = $_sNewPassword;
					
					if
					(
						$this->updateDatasets(
							array(
								'sTable' => $this->getDatabaseTablePrefix().'user', 
								'sIDColumn' => 'UserID', 
								'xIDValue' => $_axUser['UserID'], 
								'axColumnsAndValues' => $_axColumnsAndValues, 
								'xWhere' => NULL,
								'bStripSlashes' => NULL, 
								'bAllowAnonymUpdate' => true,
								'sEngine' => NULL
							)
						)
					)
					{
						if ($_sEmail != '')
						{
							$_sHtml .= $this->getText(array('sType' => 'PasswordResetTempUpdateSuccess')).'<br />';
							if ($this->sendPasswordResetMail(array('xSendToMail' => $_sEmail, 'sUsername' => $_axUser['Username'], 'sPassword' => $_sPassword)))
							{
								$_sHtml .= $this->getText(array('sType' => 'ConfimationEmailHasBeenSent'));
							}
							// else {$_sHtml .= $this->getText(array('sType' => 'PasswordResetUpdatePasswordWaitForAdminAccept'));} // TODO: alternative wenn mail nicht gesendet wurde
						}
						else {$_sHtml .= $this->getText(array('sType' => 'PasswordResetTempUpdateSucces'));}
					}
					else {$_sHtml .= $this->getText(array('sType' => 'PasswordResetTempUpdateFailed'));}
				}
			} // if _axUser
			else {$_sHtml .= $this->getText(array('sType' => 'PasswordResetEmailNotFound'));}
		} // if _oResult
		else {$_sHtml .= $this->getText(array('sType' => 'PasswordResetEmailNotFound'));}
		
		return $_sHtml;
	}
	/* @end method */

	/*
	@start method
	
	@group Password
	
	@description
	[en]Executes the resetting of the password.[/en]
	[de]Führt das Zurücksetzen des Passworts aus.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether the password has been successfully reset.[/en]
	[de]Gibt ein Boolean zurück, ob das Passwort erfolgreich Zurückgesetzt wurde.[/de]
	
	@param iUserID [needed][type]int[/type]
	[en]The user ID of the user with the password to be reset.[/en]
	[de]Die Benutzer ID vom Benutzer von dem das Passwort zurückgesetzt werden soll.[/de]
	*/
	public function resetPasswordByUserID($_iUserID)
	{
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));

		$this->checkDatabaseConnection();
		
		if (
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'user',
					'asColumns' => array('PwdReset'),
					// 'sIDColumn' => 'UserID',
					// 'xIDValue' => $_iUserID,
                    'xWhere' => array('UserID' => $_iUserID),
					'iCount' => 1
				)
			)
		)
		{
			if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
			{
                if (!empty($_axUser['PwdReset']))
                {
                    return $this->updateDatasets(
                        array(
                            'sTable' => $this->getDatabaseTablePrefix().'user',
                            'sIDColumn' => 'UserID',
                            'xIDValue' => $_iUserID,
                            'axColumnsAndValues' => array(
                                'Password' => $_axUser['PwdReset'],
                                'PwdReset' => ''
                            ),
                            'bAllowAnonymUpdate' => true
                        )
                    );
                }
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]Builds the HTML code for resetting the password and executes the password reset.[/en]
	[de]Erstellt den HTML Code für das Zurücksetzen des Passworts und führt das Zurücksetzen des Passworts aus.[/de]
	
	@return sAcceptResetHtml [type]string[/type]
	[en]Returns the HTML code as a string.[/en]
	[de]Gibt den HTML Code als String zurück.[/de]
	
	@param sSecureCode [needed][type]string[/type]
	[en]The security code is required to ensure that only authorized users can reset the password. This code is sent with the link in the confirmation email.[/en]
	[de]Der Sicherheitscode, der benütigt wird, um sicherzustellen das nur Berechtigte das Passwort zurücksetzen können. Dieser Code wird mit dem Link in der Bestätigungs-Mail gesendet.[/de]
	
	@param sEmail [type]string[/type]
	[en]The email address of the user for the password to be reset.[/en]
	[de]Die E-Mail-Adresse des Benutzers, für den das Passwort zurückgesetzt werden soll.[/de]
	
	@param sUsername [type]string[/type]
	[en]The username of the user for the password to be reset.[/en]
	[de]Der Benutzername des Benutzers, für den das Passwort zurückgesetzt werden soll.[/de]
	*/
	public function buildAcceptPasswordReset($_sSecureCode, $_sEmail = NULL, $_sUsername = NULL)
	{
		$_sEmail = $this->getRealParameter(array('oParameters' => $_sSecureCode, 'sName' => 'sEmail', 'xParameter' => $_sEmail));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sSecureCode, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		$_sSecureCode = $this->getRealParameter(array('oParameters' => $_sSecureCode, 'sName' => 'sSecureCode', 'xParameter' => $_sSecureCode));

		if ($_sEmail === NULL) {$_sEmail = '';}
		if ($_sUsername === NULL) {$_sUsername = '';}
		
		$_sHtml = '';
		
		$_sEmail = trim($_sEmail);
		$_sSecureCode = trim($_sSecureCode);
		
		if ((($_sEmail != '') || ($_sUsername != '')) && ($_sSecureCode != ''))
		{
			$this->checkDatabaseConnection();
			
			$_asColumns = array('UserID', 'Username', 'PwdReset');
			$_axWhere = NULL;
			if ($_sEmail != NULL) {$_axWhere = array('Email' => array('LIKE' => $_sEmail));}
			else {$_axWhere = array('Username' => array('LIKE' => $_sUsername));}

			if
			(
				$_oResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'user', 
						'asColumns' => $_asColumns, 
						'xWhere' => $_axWhere,
						'iStart' => NULL, 
						'iCount' => 1,
						'sOrderBy' => NULL, 
						'bOrderReverse' => NULL
					)
				)
			)
			{
				if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult, 'sEngine' => NULL)))
				{
					if ($_axUser['Username'] != '')
					{
						if ($_sSecureCode == $this->buildSecureCode(array('sUsername' => $_axUser['Username'], 'sEmail' => $_sEmail)))
						{
							if ($this->resetPasswordByUserID(array('iUserID' => $_axUser['UserID']))) {$_sHtml .= $this->getText(array('sType' => 'PasswordResetUpdatePasswordSuccess'));}
							else {$_sHtml .= $this->getText(array('sType' => 'PasswordResetUpdatePasswordFailed'));}
						}
						else {$_sHtml .= $this->getText(array('sType' => 'PasswordResetSecureCodeFailed'));}
					}
					else {$_sHtml .= $this->getText(array('sType' => 'PasswordResetEmailNotFound'));}
				} // if _axUser
				else {$_sHtml .= $this->getText(array('sType' => 'PasswordResetEmailNotFound'));}
			} // if _oResult
			else {$_sHtml .= $this->getText(array('sType' => 'PasswordResetEmailNotFound'));}
		}
		else {$_sHtml .= $this->getText(array('sType' => 'PasswordResetParametersFailed'));}
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Generate the HTML code for the confirmation of a user registration and executes the confirmation.[/en]
	[de]Erstellt den HTML Code zur Bestätigung von einer Benutzerregistrierung und führt die Bestätigung aus.[/de]
	
	@return sAcceptUserHtml [type]string[/type]
	[en]Returns the HTML code as a string.[/en]
	[de]Gibt den HTML Code als String zurück.[/de]
	
	@param sSecureCode [needed][type]string[/type]
	[en]The security code is required to ensure that only authorized users can confirm the registration. This code is sent with the link in the confirmation email.[/en]
	[de]Der Sicherheitscode, der benötigt wird, um sicherzustellen das nur Berechtigte die Registrierung bestätigen können. Dieser Code wird mit dem Link in der Bestätigungs-Mail gesendet.[/de]
	
	@param sEmail [type]string[/type]
	[en]The email adress of the user.[/en]
	[de]Die E-Mail-Adresse des Benutzers.[/de]
	
	@param sUsername [type]string[/type]
	[en]The username of the user.[/en]
	[de]Der Benutzername des Benutzers.[/de]
	*/
	public function buildAcceptUser($_sSecureCode, $_sEmail = NULL, $_sUsername = NULL)
	{
		$_sEmail = $this->getRealParameter(array('oParameters' => $_sSecureCode, 'sName' => 'sEmail', 'xParameter' => $_sEmail));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sSecureCode, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		$_sSecureCode = $this->getRealParameter(array('oParameters' => $_sSecureCode, 'sName' => 'sSecureCode', 'xParameter' => $_sSecureCode));

		if ($_sEmail === NULL) {$_sEmail = '';}
		if ($_sUsername === NULL) {$_sUsername = '';}
		
		$_sHtml = '';
		
		$_sEmail = trim($_sEmail);
		$_sUsername = trim($_sUsername);
		$_sSecureCode = trim($_sSecureCode);
		
		if ((($_sEmail != '') || ($_sUsername)) && ($_sSecureCode != ''))
		{
			$this->checkDatabaseConnection();
			
			$_asColumns = array('UserID', 'Username');
			$_axWhere = NULL;
			if ($_sEmail != '') {$_axWhere = array('Email' => array('LIKE' => $_sEmail));}
			else {$_axWhere = array('Username' => array('LIKE' => $_sUsername));}
			
			if
			(
				$_oResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'user', 
						'asColumns' => $_asColumns, 
						'xWhere' => $_axWhere,
						'iStart' => NULL, 
						'iCount' => 1,
						'sOrderBy' => NULL, 
						'bOrderReverse' => NULL
					)
				)
			)
			{
				if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult, 'sEngine' => NULL)))
				{
					if ($_axUser['Username'] != '')
					{
						if ($_sSecureCode == $this->buildSecureCode(array('sUsername' => $_axUser['Username'], 'sEmail' => $_sEmail)))
						{
							// if ($this->acceptUserByEmail(array('sEmail' => $_sEmail, 'bAccept' => true)))
							if ($this->acceptUserByID(array('iUserID' => $_axUser['UserID'], 'bAccept' => true)))
							{
								$_sHtml .= $this->getText(array('sType' => 'AccountAcceptSuccess'));
								if ($this->bSendAcceptSuccessEmail == true)
								{
									$this->sendAccountAcceptSuccessMail(array('xSendToMail' => $_sEmail, 'sUsername' => $_axUser['Username']));
								}
							}
							else {$_sHtml .= $this->getText(array('sType' => 'AccountAcceptFailed'));}
						}
						else {$_sHtml .= $this->getText(array('sType' => 'AccountAcceptSecureCodeFailed'));}
					}
					else {$_sHtml .= $this->getText(array('sType' => 'AccountAcceptEmailNotFound'));}
				}
				else {$_sHtml .= $this->getText(array('sType' => 'AccountAcceptEmailNotFound'));}
			}
			else {$_sHtml .= $this->getText(array('sType' => 'AccountAcceptEmailNotFound'));}
		}
		else {$_sHtml .= $this->getText(array('sType' => 'AccountAcceptParametersFailed'));}
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param iUserID [type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param sPassword [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function saveNewPassword($_iUserID = NULL, $_sPassword = NULL)
	{
		$_sPassword = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		
		if ($_sPassword === NULL) {$_sPassword = $this->buildRandomPassword(array('iLength' => $this->iMinCharCountPassword, 'sKey' => NULL, 'sType' => NULL));}
		if ($_sPassword != '')
		{
			$_sUsername = '';
			if ($_iUserID > 0)
			{
				if (
					$_oResult = $this->selectDatasets(
						array(
							'sTable' => $this->getDatabaseTablePrefix().'user',
							'asColumns' => array('Username'),
							'xWhere' => array('UserID' => $_iUserID),
							'iCount' => 1
						)
					)
				)
				{
					if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
					{
						$_sUsername = $_axUser['Username'];
					} // if _axUser
				} // if _oResult
			}
			else
			{
				$_iUserID = $this->getUserData(array('sProperty' => 'UserID'));
				$_sUsername = $this->getUserData(array('sProperty' => 'Username'));
			}
			
			if ($_sUsername != '')
			{
				$_sNewPassword = $this->buildPasswordCryption(array('sPassword' => $_sPassword, 'sUsername' => $_sUsername));
				if (
					$this->updateDatasets(
						array(
							'sTable' => $this->getDatabaseTablePrefix().'user',
							'sIDColumn' => 'UserID',
							'xIDValue' => $_iUserID,
							'axColumnsAndValues' => array('Password' => $_sNewPassword)
						)
					)
				)
				{
					return true;
				}
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@return sResultHtml [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param iUserID [type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param sPassword [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function buildSaveNewPassword($_iUserID = NULL, $_sPassword = NULL)
	{
		$_sPassword = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		
		$_sHtml = '';
		
		if ($_sPassword === NULL) {$_sPassword = $this->buildRandomPassword(array('iLength' => $this->iMinCharCountPassword, 'sKey' => NULL, 'sType' => NULL));}
		if ($this->saveNewPassword(array('sPassword' => $_sPassword, 'iUserID' => $_iUserID)))
		{
			$_sHtml .= '<div class="success">Das Password wurde erfolgreich geändert.</div><br />';
			if ($this->bDisplayPassword == true) {$_sHtml .= '<div class="warning" style="font-weight:bold; font-size:16px;">Das Passwort lautet: '.$_sPassword.'</div><br />';}
		}
		else {$_sHtml .= '<div class="failure">Das Password konnte nicht geändert werden!</div><br />';}
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]Sets the subject of the confirmation email when you reset passwords.[/en]
	[de]Setzt den Betreff der Bestätigungs-Mail beim Zur�cksetzen von Passwörtern.[/de]
	
	@param sSubject [needed][type]string[/type]
	[en]The subject of the confirmation mail.[/en]
	[de]Der Betreff der Bestätigungs-Mail.[/de]
	*/
	public function setMailPasswordResetSubject($_sSubject)
	{
		$_sSubject = $this->getRealParameter(array('oParameters' => $_sSubject, 'sName' => 'sSubject', 'xParameter' => $_sSubject));
		$this->sMailPasswordResetSubject = $_sSubject;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]Sets the text of the confirmation email when you reset passwords.[/en]
	[de]Setzt den Text der Bestätigungsmail beim Zurücksetzen von Passwörtern.[/de]
	
	@param sMessage [needed][type]string[/type]
	[en]The text of the confirmation mail.[/en]
	[de]Der Text der Bestätigungsmail.[/de]
	*/
	public function setMailPasswordResetMessage($_sMessage)
	{
		$_sMessage = $this->getRealParameter(array('oParameters' => $_sMessage, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		$this->sMailPasswordResetMessage = $_sMessage;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]Builds a URL to reset a password.[/en]
	[de]Erstellt eine URL zum Zurücksetzen von einem Passwort.[/de]
	
	@return sUrl [type]string[/type]
	[en]Returns the URL.[/en]
	[de]Gibt die URL zurück.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The username of the user whose password is to be reset.[/en]
	[de]Der Benutzername des Benutzers, dessen Passwort zurückgesetzt werden soll.[/de]
	
	@param sSendToMail [type]string[/type]
	[en]The email adress of the user whose password is to be reset.[/en]
	[de]Die E-Mail-Adresse des Benutzers, dessen Passwort zurückgesetzt werden soll.[/de]
	*/
	public function buildMailPasswordResetLinkUrl($_sUsername, $_sSendToMail = NULL)
	{
		$_sSendToMail = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sSendToMail', 'xParameter' => $_sSendToMail));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		
		if ($_sSendToMail === NULL) {$_sSendToMail = '';}
		
		$_sUrl = '';
		$_sUrl .= $this->sLoginGlobalUrl.$this->sPasswordResetAcceptFilePath.'?sPGAccount=password_reset&';
		if ($_sSendToMail != '') {$_sUrl .= 'sEmail='.$_sSendToMail;} else {$_sUrl .= 'sUsername='.urlencode($_sUsername);}
		$_sUrl .= '&sSecureCode='.$this->buildSecureCode(array('sUsername' => $_sUsername, 'sEmail' => $_sSendToMail));
		
		return $_sUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Password
	
	@description
	[en]Sends the confirmation mail to reset a password.[/en]
	[de]Sendet die Bestätigungsmail zum Zurücksetzen eines Passworts.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether the email was sent successfully.[/en]
	[de]Gibt einen Boolean zurück, ob die E-Mail erfolgreich gesendet wurde.[/de]
	
	@param xSendToMail [needed][type]mixed[/type]
	[en]The email adress of the user whose password is to be reset.[/en]
	[de]Die E-Mail-Adresse des Benutzers, dessen Passwort zurückgesetzt werden soll.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The username of the user whose password is to be reset.[/en]
	[de]Der Benutzername des Benutzers, dessen Passwort zurückgesetzt werden soll.[/de]
	
	@param sPassword [needed][type]string[/type]
	[en]The new password of the user whose password is to be reset.[/en]
	[de]Das neue Passwort des Benutzers, dessen Passwort zurückgesetzt werden soll.[/de]
	*/
	public function sendPasswordResetMail($_xSendToMail, $_sUsername = NULL, $_sPassword = NULL)
	{
		global $oPGMail;

		$_sUsername = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		$_sPassword = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_xSendToMail = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'xSendToMail', 'xParameter' => $_xSendToMail, 'bNotNull' => true));

		if ($this->sMailPasswordResetSubject != '') {$_sSubject = $this->sMailPasswordResetSubject;}
		else
		{
			$_sSubject = 'Passwort-Änderung: Bei Ihrem '.$this->sSystemTitle.' Account wurde das Passwort geändert. Eine Bestätigung wird benötigt.';
		}
		
		if ($this->sMailPasswordResetMessage != '') {$_sMessage = $this->sMailPasswordResetMessage;}
		else
		{
            $_sTitle = 'Hallo';
            $_sResetInfoText = 'Das Passwort Ihres '.$this->sSystemTitle.' Accounts wurd geändert.';
            $_sNeuesPassword = $_sPassword;
            $_sResetAcceptInfoText = 'Damit keine Unbefugten Ihr Passwort ändern können, benätigen wir eine Bestätigung von Ihnen.';
            $_sAcceptLink = '<a href="'.$this->buildMailPasswordResetLinkUrl(array('sUsername' => $_sUsername, 'sEmail' => $_xSendToMail)).'" target="_blank">Hier klicken um zu bestätigen</a>';
            $_sAcceptUrl = $this->buildMailPasswordResetLinkUrl(array('sUsername' => $_sUsername, 'sEmail' => $_xSendToMail));
            $_sAbortInfoText = 'Möchten Sie diese Änderung Ihres Passwort nicht vornehmen wollen, dann drücken Sie nicht den Link. Ihr altes Passwort wird dann weiter bestehen.';
            $_sSignature = 'Gruß<br />Ihr '.$this->sSystemTitle.' Team';

            global $oPGMail;
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'PasswordResetSubject', 'sReplace' => $_sSubject));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'PasswordResetTitle', 'sReplace' => $_sTitle));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'PasswordResetInfoText', 'sReplace' => $_sResetInfoText));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'PasswordResetNewPassword', 'sReplace' => $_sNeuesPassword));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'PasswordResetAcceptInfoText', 'sReplace' => $_sResetAcceptInfoText));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'PasswordResetAcceptLink', 'sReplace' => $_sAcceptLink));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'PasswordResetAcceptUrl', 'sReplace' => $_sAcceptUrl));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'PasswordResetAbortInfoText', 'sReplace' => $_sAbortInfoText));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'PasswordResetSignature', 'sReplace' => $_sSignature));

            $_sMessage = '';
			$_sMessage .= '<h1>'.$_sTitle.'</h1>';
			$_sMessage .= $_sResetInfoText.'<br />';
			$_sMessage .= 'Ihr neues Passwort lautet: '.$_sNeuesPassword.'<br />';
			$_sMessage .= $_sResetAcceptInfoText.'<br /><br />';
			$_sMessage .= $_sAcceptLink.'<br /><br />';
			$_sMessage .= $_sAcceptUrl.'<br /><br />';
			$_sMessage .= $_sAbortInfoText;
			$_sMessage .= '<br /><br /><br />';
			$_sMessage .= $_sSignature;
		}

		$oPGMail->addTemplateReplaceVar(array('sVarname' => 'Message', 'sReplace' => $_sMessage));
	
		return $this->sendMail(
            array(
                'xSendToMail' => $_xSendToMail,
                'sReplyToMail' => $this->sSystemEmail,
                'sSubject' => $_sSubject,
                'sMessage' => $_sMessage,
                'xTemplate' => $this->xPasswordResetMailTemplate
            )
        );
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Sets the subject of the confirmation email to confirm the registration of a user.[/en]
	[de]Setzt den Betreff der Bestätigungsmail zum Bestätigen der Registration eines Benutzers.[/de]
	
	@param sSubject [needed][type]string[/type]
	[en]The subject of the confirmation mail.[/en]
	[de]Der Betreff der Bestätigungsmail.[/de]
	*/
	public function setMailAcceptSubject($_sSubject)
	{
		$_sSubject = $this->getRealParameter(array('oParameters' => $_sSubject, 'sName' => 'sSubject', 'xParameter' => $_sSubject));
		$this->sMailAcceptSubject = $_sSubject;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Sets the text of the confirmation email to confirm the registration of a user.[/en]
	[de]Setzt den Text der Bestätigungsmail zum Bestätigen der Registration eines Benutzers.[/de]
	
	@param sMessage [needed][type]string[/type]
	[en]The text of the confirmation mail.[/en]
	[de]Der Text der Bestätigungsmail.[/de]
	*/
	public function setMailAcceptMessage($_sMessage)
	{
		$_sMessage = $this->getRealParameter(array('oParameters' => $_sMessage, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		$this->sMailAcceptMessage = $_sMessage;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Security
	
	@description
	[en]Builds a URL to confirm the registration of a user.[/en]
	[de]Erstellt eine URL zum Bestätigen der Registration eines Benutzers.[/de]
	
	@return sUrl [type]string[/type]
	[en]Returns the URL.[/en]
	[de]Gibt die URL zurück.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The username of the user whose registration is to be confirm.[/en]
	[de]Der Benutzername des Benutzers, dessen Registrierung bestätigt werden soll.[/de]
	
	@param sSendToMail [needed][type]string[/type]
	[en]The email adress of the user whose registration is to be confirm.[/en]
	[de]Die E-Mail-Adresse des Benutzers, dessen Registrierung bestätigt werden soll.[/de]
	*/
	public function buildMailAcceptLinkUrl($_sUsername, $_sSendToMail = NULL)
	{
		$_sSendToMail = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sSendToMail', 'xParameter' => $_sSendToMail));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		
		if ($_sSendToMail === NULL) {$_sSendToMail = '';}
		
		if (is_array($_sSendToMail)) {$_sSendToMail = $_sSendToMail[0];}
		
		$_sUrl = '';
		$_sUrl .= $this->sLoginGlobalUrl.$this->sAccountAcceptFilePath.'?sPGAccount=accept_account&';
		if ($_sSendToMail != '') {$_sUrl .= 'sEmail='.$_sSendToMail;} else {$_sUrl .= 'sUsername='.urlencode($_sUsername);}
		$_sUrl .= '&sSecureCode='.$this->buildSecureCode(array('sUsername' => $_sUsername, 'sEmail' => $_sSendToMail));
		
		return $_sUrl;
	}
	/* @end method */

	/*
	@start method
	
	@group Mail
	
	@description
	[en]Sends the confirmation mail to registration of a user.[/en]
	[de]Sendet die Bestätigungsmail zum Bestätigen der Registration eines Benutzers.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether the email was sent successfully.[/en]
	[de]Gibt einen Boolean zurück, ob die E-Mail erfolgreich gesendet wurde.[/de]
	
	@param xSendToMail [needed][type]mixed[/type]
	[en]The email adress of the user whose registration is to be confirm.[/en]
	[de]Die E-Mail-Adresse des Benutzers, dessen Registrierung bestätigt werden soll.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The username of the user whose registration is to be confirm.[/en]
	[de]Der Benutzername des Benutzers, dessen Registrierung bestätigt werden soll.[/de]
	
	@param sPassword [type]string[/type]
	[en]...[/en]
	*/
	public function sendAccountAcceptMail($_xSendToMail, $_sUsername = NULL, $_sPassword = NULL)
	{
		global $oPGMail;

		$_sUsername = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		$_sPassword = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_xSendToMail = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'xSendToMail', 'xParameter' => $_xSendToMail, 'bNotNull' => true));

		if ($this->sMailAcceptSubject != '') {$_sSubject = $this->sMailAcceptSubject;}
		else
		{
			$_sSubject = 'Account-Bestätigung: Mit Ihrer E-Mail-Adresse wurde bei '.$this->sSystemTitle.' ein Account erstellt. Eine Bestätigung wird benötigt.';
		}
		
		if ($this->sMailAcceptMessage != '') {$_sMessage = $this->sMailAcceptMessage;}
		else
		{
            $_sTitle = 'Hallo und Willkommen bei '.$this->sSystemTitle;
            $_sInfoText = 'Mit Ihrer E-Mail-Adresse wurde bei '.$this->sSystemTitle.' ein Account erstellt.';
            $_sRegisterAcceptInfoText = 'Damit keine Unbefugten über Ihre E-Mail-Adresse einen Account erstellen können, benötigen wir eine Bestätigung zum Freischalten von Ihnen.';
            $_sAcceptLink = '<a href="'.$this->buildMailAcceptLinkUrl(array('sUsername' => $_sUsername, 'sEmail' => $_xSendToMail)).'" target="_blank">Hier klicken um zu bestätigen</a>';
            $_sAcceptUrl = $this->buildMailAcceptLinkUrl(array('sUsername' => $_sUsername, 'sEmail' => $_xSendToMail));
            $_sAccountData = 'Ihre Zugangsdaten lauten wie folgt:<br />'.$this->getText(array('sType' => 'Username')).': '.$_sUsername.'<br />';
            if ($_sPassword != NULL) {$_sAccountData .= 'Passwort: '.$_sPassword.'<br />';}
            $_sAccountData .= '<br />(Alternativ zum '.$this->getText(array('sType' => 'Username')).' kann auch Ihre E-Mail-Adresse verwendet werden.)';
            $_sSignature = 'Gruß<br />Ihr '.$this->sSystemTitle.' Team';

            global $oPGMail;
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'RegisterSubject', 'sReplace' => $_sSubject));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'RegisterTitle', 'sReplace' => $_sTitle));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'RegisterInfoText', 'sReplace' => $_sInfoText));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'RegisterAcceptInfoText', 'sReplace' => $_sRegisterAcceptInfoText));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'RegisterAcceptLink', 'sReplace' => $_sAcceptLink));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'RegisterAcceptUrl', 'sReplace' => $_sAcceptUrl));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'RegisterAccountData', 'sReplace' => $_sAccountData));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'RegisterSignature', 'sReplace' => $_sSignature));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'RegisterPassword', 'sReplace' => $_sPassword));
            $oPGMail->addTemplateReplaceVar(array('sVarname' => 'RegisterUsername', 'sReplace' => $_sUsername));

            $_sMessage = '';
			$_sMessage .= '<h1>'.$_sTitle.'</h1>';
			$_sMessage .= $_sInfoText.'<br />';
			$_sMessage .= $_sRegisterAcceptInfoText.'<br /><br />';
			$_sMessage .= $_sAcceptLink.'<br /><br />';
			$_sMessage .= $_sAcceptUrl.'<br />';
			$_sMessage .= '<br />';
			$_sMessage .= $_sAccountData;
			$_sMessage .= '<br />';
			$_sMessage .= '<br /><br /><br />';
			$_sMessage .= $_sSignature;
		}

		$oPGMail->addTemplateReplaceVar(array('sVarname' => 'Message', 'sReplace' => $_sMessage));
		
		return $this->sendMail(
            array(
                'xSendToMail' => $_xSendToMail,
                'sReplyToMail' => $this->sSystemEmail,
                'sSubject' => $_sSubject,
                'sMessage' => $_sMessage,
                'xTemplate' => $this->xRegisterMailTemplate
            )
        );
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sends the success message for confirmation of the registration of a user.[/en]
	[de]Sendet per Mail die Erfolgsmeldung zur Bestätigung der Registration eines Benutzers.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether the email was sent successfully.[/en]
	[de]Gibt einen Boolean zurück, ob die E-Mail erfolgreich gesendet wurde.[/de]
	
	@param xSendToMail [needed][type]mixed[/type]
	[en]The email adress of the user whose registration was confirmed.[/en]
	[de]Die E-Mail-Adresse des Benutzers, dessen Registrierung bestätigt wurde.[/de]
	
	@param sUsername [type]string[/type]
	[en]The username of the user whose registration was confirmed.[/en]
	[de]Der Benutzername des Benutzers, dessen Registrierung bestätigt wurde.[/de]
	*/
	public function sendAccountAcceptSuccessMail($_xSendToMail, $_sUsername = NULL)
	{
		global $oPGMail;

		$_sUsername = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		$_xSendToMail = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'xSendToMail', 'xParameter' => $_xSendToMail, 'bNotNull' => true));
		
		if ($this->sMailAcceptSuccessSubject != '') {$_sSubject = $this->sMailAcceptSuccessSubject;}
		else
		{
			$_sSubject = 'Account-Bestätigung: Ihre Registrierung bei '.$this->sSystemTitle.' wurde erfolgreich freigeschaltet.';
		}
		
		if ($this->sMailAcceptSuccessMessage != '') {$_sMessage = $this->sMailAcceptSuccessMessage;}
		else
		{
            // $this->addTemplateReplaceVar(array('sVarname' => 'RegisterSubject', 'sReplace' => $_sSubject));

			$_sMessage = '';
			$_sMessage .= '<h1>Hallo und Willkommen bei '.$this->sSystemTitle.'</h1>';
			$_sMessage .= 'Mit Ihrer E-Mail-Adresse wurde bei '.$this->sSystemTitle.' ein Account erstellt.<br />';
			$_sMessage .= 'Ihr Account wurde soeben freigeschaltet und kann ab sofort benutzt werden.<br /><br />';
			if ($_sUsername != NULL)
			{
				$_sMessage .= 'Ihre Zugangsdaten lauten wie folgt:<br />';
				$_sMessage .= $this->getText(array('sType' => 'Username')).': '.$_sUsername.'<br />';
				$_sMessage .= 'Passwort: wird aus Sicherheitsgr&uuml;nden nicht mit geschickt<br />';
				$_sMessage .= '<br />';
				$_sMessage .= '(Alternativ zum '.$this->getText(array('sType' => 'Username')).' kann auch Ihre E-Mail-Adresse verwendet werden.)<br />';
				$_sMessage .= '<br /><br />';
			}
			$_sMessage .= 'Sie k&ouml;nnen sich jetzt unter <a href="'.$this->sLoginGlobalUrl.'" target="_blank">'.$this->sLoginGlobalUrl.'</a> mit Ihren Daten anmelden.<br />';
			$_sMessage .= '<br /><br />';
			$_sMessage .= '<br />';
			$_sMessage .= 'Gruß<br />Ihr '.$this->sSystemTitle.' Team';
		}

		$oPGMail->addTemplateReplaceVar(array('sVarname' => 'Message', 'sReplace' => $_sMessage));

		return $this->sendMail(
            array(
                'xSendToMail' => $_xSendToMail,
                'sReplyToMail' => $this->sSystemEmail,
                'sSubject' => $_sSubject,
                'sMessage' => $_sMessage,
                'xTemplate' => $this->xRegisterSuccessMailTemplate
            )
        );
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param xSendToMail [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sReasons [type]string[/type]
	[en]...[/en]
	*/
	public function sendAccountRegisterFailedMail($_xSendToMail, $_sReasons = NULL)
	{
		global $oPGMail;

		$_sReasons = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'sReasons', 'xParameter' => $_sReasons));
		$_xSendToMail = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'xSendToMail', 'xParameter' => $_xSendToMail, 'bNotNull' => true));
		
		if ($this->sMailRegisterFailedSubject != '') {$_sSubject = $this->sMailRegisterFailedSubject;}
		else
		{
			$_sSubject = 'Account-Registrierung-Fehlgeschlagen: Ihre Registrierung bei '.$this->sSystemTitle.' ist fehlgeschlagen!';
		}
		
		if ($this->sMailRegisterFailedMessage != '') {$_sMessage = $this->sMailRegisterFailedMessage;}
		else
		{
            // $this->addTemplateReplaceVar(array('sVarname' => 'RegisterSubject', 'sReplace' => $_sSubject));

			$_sMessage = '';
			$_sMessage .= '<h1>Hallo und Willkommen bei '.$this->sSystemTitle.'</h1>';
			$_sMessage .= 'Mit Ihrer E-Mail-Adresse wurde bei '.$this->sSystemTitle.' versucht ein Account zu erstellt.<br />';
			$_sMessage .= 'Leider ist der Versuch fehlgeschlagen.<br /><br />';
			$_sMessage .= '[reasons]';
			$_sMessage .= 'Sie k&ouml;nnen erneut versuchen Sich unter <a href="'.$this->sLoginGlobalUrl.'" target="_blank">'.$this->sLoginGlobalUrl.'</a> mit anderen Daten zu registrieren.<br />';
			$_sMessage .= '<br /><br />';
			$_sMessage .= '<br />';
			$_sMessage .= 'Gruß<br />Ihr '.$this->sSystemTitle.' Team';
		}
		
		$_sReasons = '<h2>Gründe:</h2>'.$_sReasons.'<br /><br />';
		$_sMessage = str_replace('[reasons]', $_sReasons, $_sMessage);

		$oPGMail->addTemplateReplaceVar(array('sVarname' => 'Message', 'sReplace' => $_sMessage));

		return $this->sendMail(
            array(
                'xSendToMail' => $_xSendToMail,
                'sReplyToMail' => $this->sSystemEmail,
                'sSubject' => $_sSubject,
                'sMessage' => $_sMessage,
                'xTemplate' => $this->xRegisterFailedMailTemplate
            )
        );
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mail
	
	@description
	[en]Sends an email.[/en]
	[de]Sendet eine E-Mail.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether the send was successful.[/en]
	[de]Gibt einen Boolean zurück, ob das Senden erfolgreich war.[/de]
	
	@param sSendToMail [needed][type]string[/type]
	[en]The email address of the recipient.[/en]
	[de]Die E-Mail-Adresse des Empfängers.[/de]
	
	@param sReplyToMail [needed][type]string[/type]
	[en]The email address where the response messages are sent.[/en]
	[de]Die E-Mail-Adresse wohin die Antwortmails gesendet werden.[/de]
	
	@param sSubject [needed][type]string[/type]
	[en]The subject of the email.[/en]
	[de]Der Betreff der E-Mail.[/de]
	
	@param sMessage [needed][type]string[/type]
	[en]The message of the email.[/en]
	[de]Die Nachricht der E-Mail.[/de]
	
	@param sSalutation [type]string[/type]
	[en]The salutation of the email.[/en]
	[de]Die Anrede der E-Mail.[/de]
	
	@param sSignature [type]string[/type]
	[en]The signature of the email.[/en]
	[de]Die Signatur der E-Mail.[/de]

	@param xTemplate [type]mixed[/type]
	[en]...[/en]
	*/
	public function sendMail(
        $_xSendToMail,
        $_sReplyToMail = NULL,
        $_sSubject = NULL,
        $_sMessage = NULL,
        $_sSalutation = NULL,
        $_sSignature = NULL,
        $_xTemplate = NULL
    )
	{
		global $oPGMail;

		$_sReplyToMail = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'sReplyToMail', 'xParameter' => $_sReplyToMail));
		$_sSubject = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'sSubject', 'xParameter' => $_sSubject));
		$_sMessage = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		$_sSalutation = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'sSalutation', 'xParameter' => $_sSalutation));
		$_sSignature = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'sSignature', 'xParameter' => $_sSignature));
        $_xTemplate = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));
		$_xSendToMail = $this->getRealParameter(array('oParameters' => $_xSendToMail, 'sName' => 'xSendToMail', 'xParameter' => $_xSendToMail, 'bNotNull' => true));
		
		if ($_sSalutation === NULL) {$_sSalutation = '';} else {$_sSalutation .= '<br /><br />';}
		if ($_sSignature === NULL) {$_sSignature = '';} else {$_sSignature = '<br /><br />'.$_sSignature;}
        if ($_xTemplate === NULL) {$_xTemplate = $this->xDefaultMailTemplate;}

		return $oPGMail->send(
			array(
				'sFromMail' => $this->sSystemEmail,
				'xToMail' => $_xSendToMail, 
				'sSubject' => $_sSubject,
				'sMessage' => $_sSalutation.$_sMessage.$_sSignature,
				'asAttachment' => NULL, 
				'iAttachmentsFromMailID' => NULL, 
				'bHtml' => NULL, 
				'bText' => NULL, 
				'sReplyToMail' => $_sReplyToMail, 
				'asCcMail' => NULL,
                'xTemplate' => $_xTemplate
			)
		);
	}
	/* @end method */
	
	/*
	@start method
	
	@group UserdataForm
	
	@description
	[en]Returns whether the account form was already sent.[/en]
	[de]Gibt zurück, ob das Account-Formular bereits abgeschickt wurde.[/de]
	
	@return bIsSubmitted [type]bool[/type]
	[en]Returns a boolean whether the account form was already sent.[/en]
	[de]Gibt einen Boolean zurück, ob das Account-Formular bereits abgeschickt wurde.[/de]
	*/
	public function isAccountFormSend()
	{
		return $this->isAccountFormSubmitted();
	}
	/* @end method */

	/*
	@start method
	
	@group UserdataForm
	
	@description
	[en]Returns whether the account form was already sent.[/en]
	[de]Gibt zurück, ob das Account-Formular bereits abgeschickt wurde.[/de]
	
	@return bIsSubmitted [type]bool[/type]
	[en]Returns a boolean whether the account form was already sent.[/en]
	[de]Gibt einen Boolean zurück, ob das Account-Formular bereits abgeschickt wurde.[/de]
	*/
	public function isAccountFormSubmitted()
	{
		if (isset($_POST['s'.$this->getID().'ButtonAccount'])) {return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group UserdataForm
	
	@description
	[en]Returns whether the data are correct filled out.[/en]
	[de]Gibt zurück, ob die Daten korrekt ausgefüllt wurden.[/de]
	
	@return bAccountDataOk [type]bool[/type]
	[en]Returns a boolean whether the data are correct filled out.[/en]
	[de]Gibt ein Boolean zurück, ob die Daten korrekt ausgefüllt wurden.[/de]
	
	@param bRegister [type]bool[/type]
	[en]Specifies whether the user should be created.[/en]
	[de]Gibt an ob der Benutzer neu angelegt werden soll.[/de]
	
	@param iUserID [type]int[/type]
	[en]The user ID if you want to edit an existing user.[/en]
	[de]Die Benutzer ID, wenn ein vorhandener Benutzer bearbeitet werden soll.[/de]
	
	@param asRequired [type]string[][/type]
	[en]The required fields that you want to have completed.[/en]
	[de]Die Pflichtfelder, die man ausgefüllt haben möchte.[/de]
	
	@param bPasswordRequired [type]bool[/type]
	[en]Specifies whether the password is a required field when you modify existing users.[/en]
	[de]Gibt an ob beim ändern von vorhandenen Benutzern das Passwort (altes Passwort) ein Pflichtfeld ist.[/de]
	*/
	public function isAccountFormDataCheckOk($_bRegister = NULL, $_iUserID = NULL, $_asRequired = NULL, $_bPasswordRequired = NULL, $_axFormData = NULL)
	{
		global $oPGStrings;

		$_iUserID = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		$_asRequired = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'asRequired', 'xParameter' => $_asRequired));
		$_bPasswordRequired = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bPasswordRequired', 'xParameter' => $_bPasswordRequired));
		$_axFormData = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'axFormData', 'xParameter' => $_axFormData));
		// $_bAllowChangeUsername = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bAllowChangeUsername', 'xParameter' => $_bAllowChangeUsername));
		// $_bAllowChangeEmail = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bAllowChangeEmail', 'xParameter' => $_bAllowChangeEmail));
		// $_bSendAcceptMail = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bSendAcceptMail', 'xParameter' => $_bSendAcceptMail));
		$_bRegister = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bRegister', 'xParameter' => $_bRegister));
		
		if ($_bRegister === NULL)
		{
			if ($_iUserID > 0) {$_bRegister = false;}
			else {$_bRegister = true;}
		}
		if ($_iUserID === NULL)
		{
			if ($_bRegister == false) {$_iUserID = $this->getUserData(array('sProperty' => 'UserID'));}
			else {$_iUserID = 0;}
		}
		if ($_asRequired === NULL) {$_asRequired = $this->asRequired;}
		if ($_bPasswordRequired === NULL) {$_bPasswordRequired = false;}
		// if ($_bAllowChangeUsername === NULL) {$_bAllowChangeUsername = false;}
		// if ($_bAllowChangeEmail === NULL) {$_bAllowChangeEmail = false;}
		// if ($_bSendAcceptMail === NULL) {$_bSendAcceptMail = true;}
		
		// $_iUserType = $this->iDefaultUserType;
		// if ((!$this->isGuest()) && ($_bRegister == false)) {$_iUserType = $this->getUserData(array('sProperty' => 'UserType'));}

		if ($_axFormData === NULL) {$_axFormData = $this->getSubmittedAccountFormData(array('iUserID' => $_iUserID));}

		$this->bAccountFormUserExistsError = false;
		$this->bAccountFormEmailExistsError = false;
		
		$this->bAccountFormUserMinCountError = false;
		$this->bAccountFormPasswordMinCountError = false;
		
		$this->bAccountFormEmailSyntaxCheckOk = true;
		
		$this->bAccountFormCaptchaOk = true;
		$_bRequiredFieldsOk = false;
		
		$this->bAccountFormAcceptedPrivacyPolicy = true;
		$this->bAccountFormAcceptedPrivacyTerms = true;
		$this->bAccountFormAcceptedTermsOfUse = true;
		$this->bAccountFormAcceptedTermsAndConditions = true;

		if ($this->isAccountFormSubmitted()) // submitted?
		{
			$_bRequiredFieldsOk = $this->checkRequiredFields(array('asFilled' => $_axFormData, 'bPasswordRequired' => $_bPasswordRequired, 'asRequired' => $_asRequired));

			if ($_iUserID > 0)
			{
				if ($this->bAllowChangeUsername == true)
				{
					if ((strlen(trim($_axFormData['sUsername'])) < $this->iMinCharCountUsername) && ($this->iMinCharCountUsername > 0)) {$this->bAccountFormUserMinCountError = true;}
					$this->bAccountFormUserExistsError = $this->userExists(array('sUsername' => $_axFormData['sUsername'], 'sEmail' => NULL, 'iIgnoreUserID' => $_iUserID));
				}
				if ($this->bAllowChangeEmail == true)
				{
					if (isset($oPGStrings))
					{
						$this->bAccountFormEmailSyntaxCheckOk = false;
						if (($this->bRequireEmail == false) && ($_axFormData['sEmail'] == '')) {$this->bAccountFormEmailSyntaxCheckOk = true;}
						else if ($oPGStrings->isValidEmailAdress(array('sString' => $_axFormData['sEmail']))) {$this->bAccountFormEmailSyntaxCheckOk = true;}
					}
					if ((strlen(trim($_axFormData['sPassword'])) < $this->iMinCharCountPassword) && ($_axFormData['sPassword'] != '') && ($this->iMinCharCountPassword > 0)) {$this->bAccountFormPasswordMinCountError = true;}
					$this->bAccountFormEmailExistsError = $this->userExists(array('sUsername' => NULL, 'sEmail' => $_axFormData['sEmail'], 'iIgnoreUserID' => $_iUserID));
				}
			}
			else
			{
				if (isset($oPGStrings))
				{
					$this->bAccountFormEmailSyntaxCheckOk = false;
					if (($this->bRequireEmail == false) && ($_axFormData['sEmail'] == '')) {$this->bAccountFormEmailSyntaxCheckOk = true;}
					else if ($oPGStrings->isValidEmailAdress(array('sString' => $_axFormData['sEmail']))) {$this->bAccountFormEmailSyntaxCheckOk = true;}
				}

                $this->bAccountFormUserExistsError = $this->userExists(array('sUsername' => $_axFormData['sUsername'], 'sEmail' => NULL));
				$this->bAccountFormEmailExistsError = $this->userExists(array('sUsername' => NULL, 'sEmail' => $_axFormData['sEmail']));
				
				if ((strlen(trim($_axFormData['sUsername'])) < $this->iMinCharCountUsername) && ($this->iMinCharCountUsername > 0)) {$this->bAccountFormUserMinCountError = true;}
				if (($_bRegister == true) || (trim($_axFormData['sPassword']) != ''))
				{
					if ((strlen(trim($_axFormData['sPassword'])) < $this->iMinCharCountPassword) && ($this->iMinCharCountPassword > 0)) {$this->bAccountFormPasswordMinCountError = true;}
				}
				
				if ($this->sPrivacyPolicyUrl != '') {$this->bAccountFormAcceptedPrivacyPolicy = false;}
				if ($this->sPrivacyTermsUrl != '') {$this->bAccountFormAcceptedPrivacyTerms = false;}
				if ($this->sTermsOfUseUrl != '') {$this->bAccountFormAcceptedTermsOfUse = false;}
				if ($this->sTermsAndConditionsUrl != '') {$this->bAccountFormAcceptedTermsAndConditions = false;}
				
				if ($_axFormData['bAcceptPrivacyPolicy'] == true) {$this->bAccountFormAcceptedPrivacyPolicy = true;}
				if ($_axFormData['bAcceptPrivacyTerms'] == true) {$this->bAccountFormAcceptedPrivacyTerms = true;}
				if ($_axFormData['bAcceptTermsOfUse'] == true) {$this->bAccountFormAcceptedTermsOfUse = true;}
				if ($_axFormData['bAcceptTermsAndConditions'] == true) {$this->bAccountFormAcceptedTermsAndConditions = true;}
			}

			if ($this->bRegisterWithCaptcha == true)
			{
				global $oPGCaptcha;
				$this->bAccountFormCaptchaOk = false;
				if ($oPGCaptcha->checkCaptchaKey(array('sInputKey' => $_axFormData['sCaptchaInput'], 'sCheckKey' => $_axFormData['sCaptcha']))) {$this->bAccountFormCaptchaOk = true;}
			}
		}

		if
		(
			($_bRequiredFieldsOk == true)
			&& ($this->bAccountFormUserMinCountError == false) && ($this->bAccountFormPasswordMinCountError == false)
			&& ($this->bAccountFormUserExistsError == false) && ($this->bAccountFormEmailExistsError == false)
			&& ($this->bAccountFormAcceptedPrivacyPolicy == true) && ($this->bAccountFormAcceptedPrivacyTerms == true)
			&& ($this->bAccountFormAcceptedTermsOfUse == true) && ($this->bAccountFormAcceptedTermsAndConditions == true)
			&& ($this->bAccountFormCaptchaOk == true)
		)
		{
			return true;
		}

		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group UserdataForm
	
	@description
	[en]Returns the data of the form back as soon as the form has been submitted.[/en]
	[de]Gibt die Daten des Formulars zurück sobald das Formular gesendet wurde.[/de]
	
	@return axAccountData [type]mixed[][/type]
	[en]Returns the data of the form back as an mixed array as soon as the form has been submitted.[/en]
	[de]Gibt die Daten des Formulars als mixed Array zurück sobald das Formular gesendet wurde.[/de]
	
	@param iUserID [type]int[/type]
	[en]The ID of the user for the data should be read out, as soon as that is missing in the form.[/en]
	[de]Die ID des Benutzers, für den Daten ausgelesen werden sollen, sobald welche im Formular fehlen.[/de]
	*/
	public function getSendAccountFormData($_iUserID = NULL)
	{
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		return $this->getSubmittedAccountFormData(array('iUserID' => $_iUserID));
	}
	/* @end method */
	
	/*
	@start method
	
	@group UserdataForm
	
	@description
	[en]Returns the data of the form back as soon as the form has been submitted.[/en]
	[de]Gibt die Daten des Formulars zurück sobald das Formular gesendet wurde.[/de]
	
	@return axAccountData [type]mixed[][/type]
	[en]Returns the data of the form back as an mixed array as soon as the form has been submitted.[/en]
	[de]Gibt die Daten des Formulars als mixed Array zurück sobald das Formular gesendet wurde.[/de]
	
	@param iUserID [type]int[/type]
	[en]The ID of the user for the data should be read out, as soon as that is missing in the form.[/en]
	[de]Die ID des Benutzers, für den Daten ausgelesen werden sollen, sobald welche im Formular fehlen.[/de]
	*/
	public function getSubmittedAccountFormData($_iUserID = NULL)
	{
		global $_POST;

		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		
		if ($_iUserID === NULL) {$_iUserID = 0;}
		
		$_axData = array();
		$_axData['iUserID'] = $_iUserID;
		$_axData['sUsername'] = '';
		$_axData['sEmail'] = '';
		$_axData['sEmailRetype'] = '';
		$_axData['sPassword'] = '';
		$_axData['sPasswordRetype'] = '';
		$_axData['sOldPassword'] = '';
		$_axData['sFirstName'] = '';
		$_axData['sLastName'] = '';
		$_axData['sStreet'] = '';
		$_axData['sZipCode'] = '';
		$_axData['sLocale'] = '';
		$_axData['sCountry'] = '';
		$_axData['sGender'] = '';
		$_axData['sLanguage'] = '';
		$_axData['bAcceptPrivacyPolicy'] = false;
		$_axData['bAcceptPrivacyTerms'] = false;
		$_axData['bAcceptTermsOfUse'] = false;
		$_axData['bAcceptTermsAndConditions'] = false;
		$_axData['sCaptchaInput'] = '';
		$_axData['sCaptcha'] = '';
		
		if ($_iUserID > 0)
		{
			if
			(
				$_oResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'user', 
						'asColumns' => NULL,
						'xWhere' => array('UserID' => $_iUserID),
						'iStart' => NULL, 
						'iCount' => 1,
						'sOrderBy' => NULL, 
						'bOrderReverse' => NULL
					)
				)
			)
			{
				if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult, 'sEngine' => NULL)))
				{
					$_axData['sUsername'] = $_axUser['Username'];
					$_axData['sEmail'] = $_axUser['Email'];
					$_axData['sEmailRetype'] = $_axUser['Email'];
					$_axData['sFirstName'] = $_axUser['FirstName'];
					$_axData['sLastName'] = $_axUser['LastName'];
					$_axData['sStreet'] = $_axUser['Street'];
					$_axData['sZipCode'] = $_axUser['ZipCode'];
					$_axData['sLocale'] = $_axUser['Locale'];
					$_axData['sCountry'] = $_axUser['Country'];
					$_axData['sGender'] = $_axUser['Gender'];
					$_axData['sLanguage'] = $_axUser['Language'];
				} // if _axUser
			} // if _oRes
		}
		
		if (isset($_POST['sUsername'])) {$_axData['sUsername'] = $_POST['sUsername'];}
		if (isset($_POST['sEmail'])) {$_axData['sEmail'] = $_POST['sEmail'];}
		if (isset($_POST['sEmailRetype'])) {$_axData['sEmailRetype'] = $_POST['sEmailRetype'];}
		if (isset($_POST['sPassword'])) {$_axData['sPassword'] = $_POST['sPassword'];}
		if (isset($_POST['sPasswordRetype'])) {$_axData['sPasswordRetype'] = $_POST['sPasswordRetype'];}
		if (isset($_POST['sOldPassword'])) {$_axData['sOldPassword'] = $_POST['sOldPassword'];}
		if (isset($_POST['sFirstName'])) {$_axData['sFirstName'] = $_POST['sFirstName'];}
		if (isset($_POST['sLastName'])) {$_axData['sLastName'] = $_POST['sLastName'];}
		if (isset($_POST['sStreet'])) {$_axData['sStreet'] = $_POST['sStreet'];}
		if (isset($_POST['sZipCode'])) {$_axData['sZipCode'] = $_POST['sZipCode'];}
		if (isset($_POST['sLocale'])) {$_axData['sLocale'] = $_POST['sLocale'];}
		if (isset($_POST['sCountry'])) {$_axData['sCountry'] = $_POST['sCountry'];}
		if (isset($_POST['sGender'])) {$_axData['sGender'] = $_POST['sGender'];}
		if (isset($_POST['sLanguage'])) {$_axData['sLanguage'] = $_POST['sLanguage'];}
		
		if (isset($_POST['iAcceptPrivacyPolicy'])) {if ($_POST['iAcceptPrivacyPolicy'] == 1) {$_axData['bAcceptPrivacyPolicy'] = true;}}
		if (isset($_POST['iAcceptPrivacyTerms'])) {if ($_POST['iAcceptPrivacyTerms'] == 1) {$_axData['bAcceptPrivacyTerms'] = true;}}
		if (isset($_POST['iAcceptTermsOfUse'])) {if ($_POST['iAcceptTermsOfUse'] == 1) {$_axData['bAcceptTermsOfUse'] = true;}}
		if (isset($_POST['iAcceptTermsAndConditions'])) {if ($_POST['iAcceptTermsAndConditions'] == 1) {$_axData['bAcceptTermsAndConditions'] = true;}}
		
		if (isset($_POST['sCaptchaInput'])) {$_axData['sCaptchaInput'] = $_POST['sCaptchaInput'];}
		if (isset($_POST['sCaptcha'])) {$_axData['sCaptcha'] = $_POST['sCaptcha'];}

		if (($this->bRequireUsername == false) && ($_axData['sUsername'] == '')) {$_axData['sUsername'] = $_POST['sEmail'];}
		if ($this->bEmailAsUsername == true) {if (isset($_POST['sEmail'])) {$_axData['sUsername'] = $_POST['sEmail'];}}
		
		return $_axData;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Builds the saving routine and returns the result as an HTML string.[/en]
	[de]Erstellt die Speicherroutine und gibt das Resultat als HTML-String zurück.[/de]
	
	@return sSaveAccountHtml [type]string[/type]
	[en]Returns the results of the saving as an HTML string.[/en]
	[de]Gibt die Resultate vom Speichern als HTML-String zurück.[/de]
	
	@param bRegister [type]bool[/type]
	[en]Specifies whether the user should be created.[/en]
	[de]Gibt an ob der Benutzer neu angelegt werden soll.[/de]
	
	@param iUserID [needed][type]int[/type]
	[en]The user ID if the user already exists.[/en]
	[de]Die Benutzer ID, wenn der Benutzer bereits vorhanden ist.[/de]
	
	@param iUserType [needed][type]int[/type]
	[en]
		The type of the user.
		The following user types are possible:
		%LoginUserTypes%
	[/en]
	[de]
		Der Typ des Benutzers.
		Folgende Benutzertypen sind möglich:
		%LoginUserTypes%
	[/de]
	
	@param sGender [needed][type]string[/type]
	[en]The gender of the user.[/en]
	[de]Das Geschlecht des Benutzers.[/de]
	
	@param sFirstName [needed][type]string[/type]
	[en]The first name of the user.[/en]
	[de]Der Vorname des Benutzers.[/de]
	
	@param sLastName [needed][type]string[/type]
	[en]The last name of the user.[/en]
	[de]Der Nachname des Benutzers.[/de]
	
	@param sStreet [needed][type]string[/type]
	[en]The street of the user.[/en]
	[de]Die Straße des Benutzers.[/de]
	
	@param sZipCode [needed][type]string[/type]
	[en]The zip code of the user.[/en]
	[de]Der Postleitzahl des Benutzers.[/de]
	
	@param sLocale [needed][type]string[/type]
	[en]The locale of the user.[/en]
	[de]Der Ort des Benutzers.[/de]
	
	@param sCountry [needed][type]string[/type]
	[en]The Country of the user.[/en]
	[de]Das Land des Benutzers.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The username of the user.[/en]
	[de]Der Benutzername des Benutzers.[/de]
	
	@param sEmail [needed][type]string[/type]
	[en]The email adress of the user.[/en]
	[de]Der E-Mail-Adresse des Benutzers.[/de]
	
	@param sPassword [needed][type]string[/type]
	[en]The password of the user.[/en]
	[de]Der Passwort des Benutzers.[/de]
	
	@param sOldPassword [needed][type]string[/type]
	[en]The old password, if one is already present.[/en]
	[de]Das alte Passwort des Benutzers, falls bereits eins vorhanden ist.[/de]
	
	@param sLanguage [needed][type]string[/type]
	[en]The language of the user.[/en]
	[de]Die Sprache des Benutzers.[/de]
	
	@param bAllowChangeUsername [type]bool[/type]
	[en]Specifies whether the change of the username of an existing user is allowed.[/en]
	[de]Gibt an ob das ändern des Benutzernamen eines existierenden Benutzers erlaubt ist.[/de]
	
	@param bAllowChangeEmail [type]bool[/type]
	[en]Specifies whether the change of the email adress of an existing user is allowed.[/en]
	[de]Gibt an ob das ändern der E-Mail-Adresse eines existierenden Benutzers erlaubt ist.[/de]
	
	@param bSendAcceptMail [type]bool[/type]
	[en]Specifies whether a message should be sent to the e-mail address to accept the account.[/en]
	[de]Gibt an ob eine Mail zum Akzeptieren des Accounts an die E-Mail-Adresse geschickt werden soll.[/de]

	@param bSendMailWithPassword [type]bool[/type]
	[en]...[/en]
	
	@param bDisplayPassword [type]bool[/type]
	[en]...[/en]
	
	@param bAcceptUser [type]bool[/type]
	[en]...[/en]
	*/
	public function buildAccountSave(
		$_bRegister,
		$_iUserID = NULL, 
		$_iUserType = NULL, 
		$_sGender = NULL, 
		$_sFirstName = NULL, 
		$_sLastName = NULL, 
		$_sStreet = NULL, 
		$_sZipCode = NULL, 
		$_sLocale = NULL, 
		$_sCountry = NULL, 
		$_sUsername = NULL,
		$_sEmail = NULL,
		$_sPassword = NULL, 
		$_sOldPassword = NULL,
		$_sLanguage = NULL,
		$_bAllowChangeUsername = NULL,
		$_bAllowChangeEmail = NULL,
		$_bSendAcceptMail = NULL,
		$_bSendMailWithPassword = NULL,
		$_bDisplayPassword = NULL,
		$_bAcceptUser = NULL
	)
	{
		$_iUserID = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		$_iUserType = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'iUserType', 'xParameter' => $_iUserType));
		$_sGender = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'sGender', 'xParameter' => $_sGender));
		$_sFirstName = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'sFirstName', 'xParameter' => $_sFirstName));
		$_sLastName = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'sLastName', 'xParameter' => $_sLastName));
		$_sStreet = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'sStreet', 'xParameter' => $_sStreet));
		$_sZipCode = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'sZipCode', 'xParameter' => $_sZipCode));
		$_sLocale = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'sLocale', 'xParameter' => $_sLocale));
		$_sCountry = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'sCountry', 'xParameter' => $_sCountry));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		$_sEmail = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'sEmail', 'xParameter' => $_sEmail));
		$_sPassword = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_sOldPassword = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'sOldPassword', 'xParameter' => $_sOldPassword));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_bAllowChangeUsername = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bAllowChangeUsername', 'xParameter' => $_bAllowChangeUsername));
		$_bAllowChangeEmail = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bAllowChangeEmail', 'xParameter' => $_bAllowChangeEmail));
		$_bSendAcceptMail = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bSendAcceptMail', 'xParameter' => $_bSendAcceptMail));
		$_bSendMailWithPassword = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bSendMailWithPassword', 'xParameter' => $_bSendMailWithPassword));
		$_bDisplayPassword = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bDisplayPassword', 'xParameter' => $_bDisplayPassword));
		$_bAcceptUser = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bAcceptUser', 'xParameter' => $_bAcceptUser));
		$_bRegister = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bRegister', 'xParameter' => $_bRegister));

		if ($_bRegister === NULL)
		{
			if ($_iUserID > 0) {$_bRegister = false;}
			else {$_bRegister = true;}
		}
		if ($_iUserID === NULL)
		{
			if ($_bRegister == false) {$_iUserID = $this->getUserData(array('sProperty' => 'UserID'));}
			else {$_iUserID = 0;}
		}
		if ($_bAllowChangeUsername === NULL) {$_bAllowChangeUsername = false;}
		if ($_bAllowChangeEmail === NULL) {$_bAllowChangeEmail = false;}
		if ($_bSendAcceptMail === NULL) {$_bSendAcceptMail = $this->bSendAcceptRequestEmail;}
		if ($_bSendMailWithPassword === NULL) {$_bSendMailWithPassword = false;}
		if ($_bDisplayPassword === NULL) {$_bDisplayPassword = false;}
		if ($_bAcceptUser === NULL) {$_bAcceptUser = false;}
		
		if (($_iUserType === NULL) || ($_iUserType === 0))
		{
			if (($_iUserID === NULL) || ($_iUserID === 0)) {$_iUserType = $this->iDefaultUserType;}
			if ($_iUserID == $this->getUserData(array('sProperty' => 'UserID'))) {$_iUserType = $this->getUserData(array('sProperty' => 'UserType'));}
		}
		
		$_sHtml = '';
		
		if ($_iUserID > 0)
		{
			if ($_bAllowChangeUsername == false) {$_sUsername = NULL;}
			if ($_bAllowChangeEmail == false) {$_sEmail = NULL;}
		}
		
		if
		(
			$_iUserID = $this->saveAccount(
				array(
					'iUserID' => $_iUserID, 'iUserType' => $_iUserType, 'sGender' => $_sGender, 'sFirstName' => $_sFirstName, 'sLastName' => $_sLastName, 
					'sStreet' => $_sStreet, 'sZipCode' => $_sZipCode, 'sLocale' => $_sLocale, 'sCountry' => $_sCountry, 
					'sUsername' => $_sUsername, 'sEmail' => $_sEmail, 'sPassword' => $_sPassword, 'sOldPassword' => $_sOldPassword, 'sLanguage' => $_sLanguage
				)
			)
		)
		{
			// if ($_POST['s'.$this->getID().'Account'] == 'edit')
			if ($_bRegister == false)
			{
				$_sHtml .= '<div class="success">Ihre Accountdaten wurden erfolgreich ge&auml;ndert.</div><br />';
			}
			else
			{
				$_sHtml .= '<div class="success">'.$this->getText(array('sType' => 'AccountRegisterSuccess')).'</div><br />';
				if ($_bDisplayPassword == true) {$_sHtml .= '<div class="warning" style="font-weight:bold; font-size:16px;">Das Passwort lautet: '.$_sPassword.'</div><br />';}
				if ($_bSendAcceptMail == true)
				{
					$_sSendPassword = NULL;
					if ($_bSendMailWithPassword == true) {$_sSendPassword = $_sPassword;}
					$_asToMail = array();
					if ($_sEmail != '') {$_asToMail[] = $_sEmail;}
					if ($this->bMailAcceptToSystemEmail == true) {$_asToMail[] = $this->sSystemEmail;}
					if (trim($this->sMailAcceptToEmails) != '')
					{
						$_asToMail = array_merge($_asToMail, explode(';', str_replace(',', ';', trim($this->sMailAcceptToEmails))));
					}
					
					if (count($_asToMail))
					{
						if ($this->sendAccountAcceptMail(array('xSendToMail' => $_asToMail, 'sUsername' => $_sUsername, 'sPassword' => $_sSendPassword)))
						{
							if ($_sEmail != '')
							{
								$_sHtml .= '<div class="success">';
									// $_sHtml .= 'Ihnen wurde eine E-Mail an die Adresse "'.$_sEmail.'" gesandt.<br />';
									$_sHtml .= $this->getText(array('sType' => 'ConfimationEmailHasBeenSent')).'<br />';
									$_sHtml .= 'In dieser E-Mail steht beschrieben wie Sie Ihr Benutzerkonto freischalten k&ouml;nnen.<br />';
								$_sHtml .= '</div>';
							}
						}
						else
						{
							if ($_sEmail != '')
							{
								$_sHtml .= '<div class="failure">';
									$_sHtml .= 'Ein Fehler ist aufgetreten!<br />Es konnte keine E-Mail an "'.$_sEmail.'" gesendet werden!<br />';
									$_sHtml .= 'Bitte kontaktieren Sie uns unter <a href="mailto:'.$this->sSystemEmail.'?subject='.urlencode('Registierungsproblem: E-Mail wurde nicht versandt!').'">'.$this->sSystemEmail.'</a>.<br />';
								$_sHtml .= '</div>';
							}
						}
						$_sHtml .= '<br />';
					}
				}
				else {$_sHtml .= '<div class="warning">'.$this->getText(array('sType' => 'AccountRegisterWaitForAdminAccept')).'</div>';}
			}
			if ($_bAcceptUser == true)
			{
				if ($this->acceptUserByID(array('iUserID' => $_iUserID))) {$_sHtml .= '<div class="success">Der Account wurde automatisch freigeschaltet und muss <span style="font-weight:bold; text-decoration:underline;">nicht</span> mehr per E-Mail best&auml;tigt werden.</div><br />';}
				else {$_sHtml .= '<div class="failure">Der Account konnte nicht automatisch freigeschaltet werden. Bitte kontaktieren Sie den Administrator dieser Webseite.</div><br />';}
			}
		}
		else
		{
			$_sHtml .= '<div class="failure">';
			if ($_bRegister == true) {$_sHtml .= $this->getText(array('sType' => 'AccountRegisterFailed'));}
			else {$_sHtml .= $this->getText(array('sType' => 'AccountChangeFailed'));}
			$_sHtml .= '</div>';
		}
		$_sHtml .= '<br />';
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Userdata
	
	@description
	[en]Builds the saving routine and returns the result as an HTML string.[/en]
	[de]Erstellt die Speicherroutine und gibt das Resultat als HTML-String zurück.[/de]
	
	@return sSaveAccountHtml [type]string[/type]
	[en]Returns the results of the saving as an HTML string.[/en]
	[de]Gibt die Resultate vom Speichern als HTML-String zurück.[/de]

	@param bRegister [type]bool[/type]
	[en]Specifies whether the user should be created.[/en]
	[de]Gibt an ob der Benutzer neu angelegt werden soll.[/de]
	
	@param iUserID [type]int[/type]
	[en]The user ID if the user already exists.[/en]
	[de]Die Benutzer ID, wenn der Benutzer bereits vorhanden ist.[/de]
	
	@param iUserType [needed][type]int[/type]
	[en]
		The type of the user.
		The following user types are possible:
		%LoginUserTypes%
	[/en]
	[de]
		Der Typ des Benutzers.
		Folgende Benutzertypen sind möglich:
		%LoginUserTypes%
	[/de]
	
	@param axUserData [type]mixed[][/type]
	[en]The form data as it was transmitted when you submit this form.[/en]
	[de]Die Formulardaten, wie sie beim abschicken des Formulars übertragen wurden.[/de]
	
	@param bAllowChangeUsername [type]bool[/type]
	[en]Specifies whether the change of the username of an existing user is allowed.[/en]
	[de]Gibt an ob das ändern des Benutzernamen eines existierenden Benutzers erlaubt ist.[/de]
	
	@param bAllowChangeEmail [type]bool[/type]
	[en]Specifies whether the change of the email adress of an existing user is allowed.[/en]
	[de]Gibt an ob das ändern der E-Mail-Adresse eines existierenden Benutzers erlaubt ist.[/de]
	
	@param bSendAcceptMail [type]bool[/type]
	[en]Specifies whether a message should be sent to the e-mail address to accept the account.[/en]
	[de]Gibt an ob eine Mail zum Akzeptieren des Accounts an die E-Mail-Adresse geschickt werden soll.[/de]
	
	@param bSendMailWithPassword [type]bool[/type]
	[en]...[/en]
	
	@param bDisplayPassword [type]bool[/type]
	[en]...[/en]
	
	@param bAcceptUser [type]bool[/type]
	[en]...[/en]
	*/
	public function buildAccountSave2(
		$_bRegister,
		$_iUserID = NULL, 
		$_iUserType = NULL,
		$_axUserData = NULL,
		$_bAllowChangeUsername = NULL,
		$_bAllowChangeEmail = NULL,
		$_bSendAcceptMail = NULL,
		$_bSendMailWithPassword = NULL,
		$_bDisplayPassword = NULL,
		$_bAcceptUser = NULL
	)
	{
		$_iUserID = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		$_iUserType = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'iUserType', 'xParameter' => $_iUserType));
		$_axUserData = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'axUserData', 'xParameter' => $_axUserData));
		$_bAllowChangeUsername = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bAllowChangeUsername', 'xParameter' => $_bAllowChangeUsername));
		$_bAllowChangeEmail = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bAllowChangeEmail', 'xParameter' => $_bAllowChangeEmail));
		$_bSendAcceptMail = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bSendAcceptMail', 'xParameter' => $_bSendAcceptMail));
		$_bSendMailWithPassword = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bSendMailWithPassword', 'xParameter' => $_bSendMailWithPassword));
		$_bDisplayPassword = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bDisplayPassword', 'xParameter' => $_bDisplayPassword));
		$_bAcceptUser = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bAcceptUser', 'xParameter' => $_bAcceptUser));
		$_bRegister = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bRegister', 'xParameter' => $_bRegister));
		
		return $this->buildAccountSave(
			array(
				'bRegister' => $_bRegister,
				'iUserID' => $_iUserID, 'iUserType' => $_iUserType, 'sGender' => $_axUserData['sGender'], 'sFirstName' => $_axUserData['sFirstName'], 'sLastName' => $_axUserData['sLastName'], 
				'sStreet' => $_axUserData['sStreet'], 'sZipCode' => $_axUserData['sZipCode'], 'sLocale' => $_axUserData['sLocale'], 'sCountry' => $_axUserData['sCountry'], 
				'sUsername' => $_axUserData['sUsername'], 'sEmail' => $_axUserData['sEmail'], 'sPassword' => $_axUserData['sPassword'], 'sOldPassword' => $_axUserData['sOldPassword'], 'sLanguage' => $_axUserData['sLanguage'],
				'bAllowChangeUsername' => $_bAllowChangeUsername,
				'bAllowChangeEmail' => $_bAllowChangeEmail,
				'bSendAcceptMail' => $_bSendAcceptMail,
				'bSendMailWithPassword' => $_bSendMailWithPassword,
				'bDisplayPassword' => $_bDisplayPassword,
				'bAcceptUser' => $_bAcceptUser
			)
		);
	}
	/* @end method */
	
	/*
	@start method
	
	@group UserdataForm
	
	@description
	[en]Creates an HTML string with error messages at filling out of the account entry form and returns it.[/en]
	[de]Erstellt einen HTML-String mit Fehlermeldungen beim Ausfüllen vom Account-Eingabeformular und gibt ihn zurück.[/de]
	
	@return sErrorsHtml [type]string[/type]
	[en]Returns error messages at filling out of the account entry form as an HTML string.[/en]
	[de]Gibt Fehlermeldungen beim Ausfüllen vom Account-Eingabeformular als HTML-String zurück.[/de]
	
	@param iUserID [needed][type]int[/type]
	[en]...[/en]
	*/
	public function buildAccountFormSubmitErrors($_iUserID, $_axUserFormData = NULL)
	{
		$_axUserFormData = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'axUserFormData', 'xParameter' => $_axUserFormData));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));

		$_sHtml = '';
		if ($this->isAccountFormSubmitted())
		{
			if ($_axUserFormData === NULL) {$_axUserFormData = $this->getSubmittedAccountFormData(array('iUserID' => $_iUserID));}
		
			if ($this->bAccountFormUserMinCountError == true) {$_sHtml .= '<span style="color:#ff0000;">Der '.$this->getText(array('sType' => 'Username')).' muss mindestens '.$this->iMinCharCountUsername.' Zeichen haben.</span><br />';}
			if ($this->bAccountFormPasswordMinCountError == true) {$_sHtml .= '<span style="color:#ff0000;">Das Passwort muss mindestens '.$this->iMinCharCountPassword.' Zeichen haben.</span><br />';}
			if ($this->bAccountFormEmailSyntaxCheckOk == false) {$_sHtml .= '<span style="color:#ff0000;">Bitte geben Sie eine g&uuml;ltige E-Mail-Adresse ein. (Eingabe: '.$_axUserFormData['sEmail'].')</span><br />';}
			
			if ($this->bAccountFormUserExistsError == true) {$_sHtml .= '<span style="color:#ff0000;">'.str_replace('[username]', $_axUserFormData['sUsername'], $this->getText(array('sType' => 'AccountFormUserExistsError'))).'</span><br />';}
			if ($this->bAccountFormEmailExistsError == true) {$_sHtml .= '<span style="color:#ff0000;">'.str_replace('[email]', $_axUserFormData['sEmail'], $this->getText(array('sType' => 'AccountFormEmailExistsError'))).'</span><br />';}
			if (trim($_axUserFormData['sEmail']) != trim($_axUserFormData['sEmailRetype'])) {$_sHtml .= '<span style="color:#ff0000;">'.str_replace('[email]', $_axUserFormData['sEmail'], str_replace('[email_retype]', $_axUserFormData['sEmailRetype'], $this->getText(array('sType' => 'AccountFormEmailMatchError')))).'</span><br />';}
			if (trim($_axUserFormData['sPassword']) != trim($_axUserFormData['sPasswordRetype'])) {$_sHtml .= '<span style="color:#ff0000;">'.$this->getText(array('sType' => 'AccountFormPasswordMatchError')).'</span><br />';}
			
			if (!isset($_axUserFormData['bAcceptedPrivacyPolicy'])) {$_axUserFormData['bAcceptedPrivacyPolicy'] = false;}
			if (!isset($_axUserFormData['bAcceptedPrivacyTerms'])) {$_axUserFormData['bAcceptedPrivacyTerms'] = false;}
			if (!isset($_axUserFormData['bAcceptedTermsOfUse'])) {$_axUserFormData['bAcceptedTermsOfUse'] = false;}
			if (!isset($_axUserFormData['bAcceptedTermsAndConditions'])) {$_axUserFormData['bAcceptedTermsAndConditions'] = false;}
			
			if (($_axUserFormData['bAcceptedPrivacyPolicy'] == false) && ($this->sPrivacyPolicyUrl != '')) {$_sHtml .= '<span style="color:#ff0000;">'.$this->getText(array('sType' => 'AcceptPrivacyPolicyFailed')).'</span><br />';}
			if (($_axUserFormData['bAcceptedPrivacyTerms'] == false) && ($this->sPrivacyTermsUrl != '')) {$_sHtml .= '<span style="color:#ff0000;">'.$this->getText(array('sType' => 'AcceptPrivacyTermsFailed')).'</span><br />';}
			if (($_axUserFormData['bAcceptedTermsOfUse'] == false) && ($this->sTermsOfUseUrl != '')) {$_sHtml .= '<span style="color:#ff0000;">'.$this->getText(array('sType' => 'AcceptTermsOfUseFailed')).'</span><br />';}
			if (($_axUserFormData['bAcceptedTermsAndConditions'] == false) && ($this->sTermsAndConditionsUrl != '')) {$_sHtml .= '<span style="color:#ff0000;">'.$this->getText(array('sType' => 'AcceptTermsAndConditionsFailed')).'</span><br />';}
			
			if ($this->bAccountFormCaptchaOk == false) {$_sHtml .= '<span style="color:#ff0000;">'.$this->getText(array('sType' => 'CaptchaFailed')).'</span><br />';}
		}
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group UserdataForm
	
	@description
	[en]Builds the input form for new user registrations and changes of existing users.[/en]
	[de]Erstellt das Eingabeformular für Registrierungen neuer Benutzer und änderungen bestehender Benutzer.[/de]
	
	@return sAccountFormHtml [type]string[/type]
	[en]Returns the HTML code as a string.[/en]
	[de]Gibt den HTML Code als String zurück.[/de]
	
	@param bRegister [type]bool[/type]
	[en]Specifies whether the user should be created.[/en]
	[de]Gibt an ob der Benutzer neu angelegt werden soll.[/de]
	
	@param iUserID [type]int[/type]
	[en]The user ID if you want to edit an existing user.[/en]
	[de]Die Benutzer ID, wenn ein vorhandener Benutzer bearbeitet werden soll.[/de]
	
	@param asRequired [type]string[][/type]
	[en]The required fields that you want to have completed.[/en]
	[de]Die Pflichtfelder, die man ausgefüllt haben möchte.[/de]
	
	@param bPasswordRequired [type]bool[/type]
	[en]Specifies whether the password is a required field when you modify existing users.[/en]
	[de]Gibt an ob beim ändern von vorhandenen Benutzern das Passwort (altes Passwort) ein Pflichtfeld ist.[/de]
	
	@param bAutoGeneratePassword [type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param bDisplayPassword [type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param bAllowChangeUsername [type]bool[/type]
	[en]Specifies whether the change of the username of an existing user is allowed.[/en]
	[de]Gibt an ob das ändern des Benutzernamen eines existierenden Benutzers erlaubt ist.[/de]
	
	@param bAllowChangeEmail [type]bool[/type]
	[en]Specifies whether the change of the email adress of an existing user is allowed.[/en]
	[de]Gibt an ob das ändern der E-Mail-Adresse eines existierenden Benutzers erlaubt ist.[/de]
	
	@param bSendAcceptMail [type]bool[/type]
	[en]Specifies whether a message should be sent to the e-mail address to accept the account.[/en]
	[de]Gibt an ob eine Mail zum Akzeptieren des Accounts an die E-Mail-Adresse geschickt werden soll.[/de]
	
	@param bSendMailWithPassword [type]bool[/type]
	[en]...[/en]
	
	@param bAcceptUser [type]bool[/type]
	[en]...[/en]
	*/
	public function buildAccountForm(
		$_bRegister = NULL,
		$_iUserID = NULL,
		$_asRequired = NULL,
		$_bPasswordRequired = NULL,
		$_bAutoGeneratePassword = NULL,
		$_bDisplayPassword = NULL,
		$_bAllowChangeUsername = NULL,
		$_bAllowChangeEmail = NULL,
		$_bSendAcceptMail = NULL,
		$_bSendMailWithPassword = NULL,
		$_bAcceptUser = NULL,
        $_xTemplate = NULL
    )
	{
		global $_POST, $_SERVER, $oPGStrings;

		$_iUserID = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		$_asRequired = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'asRequired', 'xParameter' => $_asRequired));
		$_bPasswordRequired = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bPasswordRequired', 'xParameter' => $_bPasswordRequired));
		$_bAutoGeneratePassword = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bAutoGeneratePassword', 'xParameter' => $_bAutoGeneratePassword));
		$_bDisplayPassword = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bDisplayPassword', 'xParameter' => $_bDisplayPassword));
		$_bAllowChangeUsername = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bAllowChangeUsername', 'xParameter' => $_bAllowChangeUsername));
		$_bAllowChangeEmail = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bAllowChangeEmail', 'xParameter' => $_bAllowChangeEmail));
		$_bSendAcceptMail = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bSendAcceptMail', 'xParameter' => $_bSendAcceptMail));
		$_bSendMailWithPassword = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bSendMailWithPassword', 'xParameter' => $_bSendMailWithPassword));
		$_bAcceptUser = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bAcceptUser', 'xParameter' => $_bAcceptUser));
        $_xTemplate = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));
		$_bRegister = $this->getRealParameter(array('oParameters' => $_bRegister, 'sName' => 'bRegister', 'xParameter' => $_bRegister));
		
		if ($_bRegister === NULL)
		{
			if ($_iUserID > 0) {$_bRegister = false;}
			else {$_bRegister = true;}
		}
		if ($_iUserID === NULL)
		{
			if ($_bRegister == false) {$_iUserID = $this->getUserData(array('sProperty' => 'UserID'));}
			else {$_iUserID = 0;}
		}
		if ($_asRequired === NULL) {$_asRequired = $this->asRequired;}
		if ($_bAllowChangeUsername === NULL) {$_bAllowChangeUsername = $this->bAllowChangeUsername;}
		if ($_bAllowChangeEmail === NULL) {$_bAllowChangeEmail = $this->bAllowChangeEmail;}
		if ($_bSendAcceptMail === NULL) {$_bSendAcceptMail = $this->bSendAcceptRequestEmail;}
		if ($_bPasswordRequired === NULL) {$_bPasswordRequired = false;}
		if ($_bAutoGeneratePassword === NULL) {$_bAutoGeneratePassword = $this->bAutoGeneratePassword;}
		if ($_bDisplayPassword === NULL) {$_bDisplayPassword = $this->bDisplayPassword;}
		if ($_bAcceptUser === NULL) {$_bAcceptUser = false;}
		
		$_iUserType = $this->iDefaultUserType;
		if ((!$this->isGuest()) && ($_bRegister == false)) {$_iUserType = $this->getUserData(array('sProperty' => 'UserType'));}
		
		if ($this->getUrl() == '') {$this->setUrl($_SERVER['PHP_SELF']);}
		if ($this->getUrl() == '') {$this->setUrl('index.php');}

		$_sUsername = '';
		$_sEmail = '';
		$_sEmailRetype = '';
		$_sPassword = '';
		$_sPasswordRetype = '';
		$_sOldPassword = '';
		$_sFirstName = '';
		$_sLastName = '';
		$_sStreet = '';
		$_sZipCode = '';
		$_sLocale = '';
		$_sCountry = '';
		$_sGender = '';
		$_sLanguage = '';

		$_sHtml = '';

		if ($_axFormData = $this->getSubmittedAccountFormData(array('iUserID' => $_iUserID)))
		{
            if ($this->bAccountFormRequireEmailRetype == false) {$_axFormData['sEmailRetype'] = $_axFormData['sEmail'];}
            if ($this->bAccountFormRequirePasswordRetype == false) {$_axFormData['sPasswordRetype'] = $_axFormData['sPassword'];}

			$_sUsername = $_axFormData['sUsername'];
			$_sEmail = $_axFormData['sEmail'];
            $_sEmailRetype = $_axFormData['sEmailRetype'];
			if (($_bAutoGeneratePassword == true) && ($_bRegister == true))
			{
				$_axFormData['sPassword'] = $this->buildRandomPassword();
				$_axFormData['sPasswordRetype'] = $_axFormData['sPassword'];
			}
			$_sPassword = $_axFormData['sPassword'];
            $_sPasswordRetype = $_axFormData['sPasswordRetype'];
			$_sOldPassword = $_axFormData['sOldPassword'];
			$_sFirstName = $_axFormData['sFirstName'];
			$_sLastName = $_axFormData['sLastName'];
			$_sStreet = $_axFormData['sStreet'];
			$_sZipCode = $_axFormData['sZipCode'];
			$_sLocale = $_axFormData['sLocale'];
			$_sCountry = $_axFormData['sCountry'];
			$_sGender = $_axFormData['sGender'];
			$_sLanguage = $_axFormData['sLanguage'];
		}

		if (
            $this->isAccountFormDataCheckOk(
                array(
                    'bRegister' => $_bRegister,
                    'iUserID' => $_iUserID,
                    'asRequired' => $_asRequired,
                    'bPasswordRequired' => $_bPasswordRequired,
                    'axFormData' => $_axFormData
                )
            )
        )
		{
            $_sHtml .= $this->buildAccountSave2(
				array(
					'bRegister' => $_bRegister,
					'iUserID' => $_iUserID, 'iUserType' => $_iUserType, 
					'axUserData' => $_axFormData,
					'bAllowChangeUsername' => $_bAllowChangeUsername,
					'bAllowChangeEmail' => $_bAllowChangeEmail,
					'bSendAcceptMail' => $_bSendAcceptMail,
					'bSendMailWithPassword' => $_bSendMailWithPassword,
					'bDisplayPassword' => $_bDisplayPassword,
					'bAcceptUser' => $_bAcceptUser
				)
			);
		}
		else
		{
			$_sErrorReasons = $this->buildAccountFormSubmitErrors(array('iUserID' => $_iUserID, 'axFormData' => $_axFormData));

            if ($this->isAccountFormSubmitted())
            {
                if (
                    (count($this->asRequiredFailed))
                    || ($this->bAccountFormUserExistsError == true) || ($this->bAccountFormUserMinCountError == true)
                    || ($this->bAccountFormPasswordMinCountError == true)
                    || ($this->bAccountFormEmailExistsError == true) || ($this->bAccountFormEmailSyntaxCheckOk == false)
                )
                {
                    if (($this->bMailRegisterFailedToSystemEmail == true) || ($this->sMailRegisterFailedToEmails != ''))
                    {
                        $_sSendToMails = '';
                        if ($this->bMailRegisterFailedToSystemEmail == true) {$_sSendToMails .= $this->sSystemEmail;}
                        if ($this->bSendRegisterFailedEmail == true)
                        {
                            if ($_sSendToMails != '') {$_sSendToMails .= ', ';}
                            $_sSendToMails .= $_axFormData['sEmail'];
                        }
                        if ($this->sMailRegisterFailedToEmails != '')
                        {
                            if ($_sSendToMails != '') {$_sSendToMails .= ', ';}
                            $_sSendToMails .= $this->sMailRegisterFailedToEmails;
                        }
                        $this->sendAccountRegisterFailedMail(array('xSendToMail' => $_sSendToMails, 'sReasons' => $_sErrorReasons));
                    }
                }
            }

            if (!empty($_xTemplate))
            {
                $_sHiddenFields = '';
                $_sHiddenFields .= '<input type="hidden" name="s'.$this->getID().'Account" value="';
                if ($_bRegister == true) {$_sHiddenFields .= 'register';} else {$_sHiddenFields .= 'edit';}
                $_sHiddenFields .= '" />';
                $_sHiddenFields .= '<input type="hidden" name="iUserID" value="'.$_iUserID.'" />';

                $this->addTemplateReplaceVar(array('sVarname' => 'FormUrl', 'sReplace' => $this->getUrl()));
                $this->addTemplateReplaceVar(array('sVarname' => 'FormTarget', 'sReplace' => $this->getUrlTarget()));
                $this->addTemplateReplaceVar(array('sVarname' => 'FormUrlParameters', 'sReplace' => $this->getUrlParametersForm().$_sHiddenFields));

                $this->addTemplateReplaceVar(array('sVarname' => 'ErrorMessage', 'sReplace' => $_sErrorReasons));

                $this->addTemplateReplaceVar(array('sVarname' => 'FieldNameUsername', 'sReplace' => 'sUsername'));
                $this->addTemplateReplaceVar(array('sVarname' => 'FieldNamePassword', 'sReplace' => 'sPassword'));
				$this->addTemplateReplaceVar(array('sVarname' => 'FieldNamePasswordRetype', 'sReplace' => 'sPasswordRetype'));
                $this->addTemplateReplaceVar(array('sVarname' => 'FieldNameEmail', 'sReplace' => 'sEmail'));
                $this->addTemplateReplaceVar(array('sVarname' => 'FieldNameFirstName', 'sReplace' => 'sFirstName'));
                $this->addTemplateReplaceVar(array('sVarname' => 'FieldNameLastName', 'sReplace' => 'sLastName'));
                $this->addTemplateReplaceVar(array('sVarname' => 'FieldNameStreet', 'sReplace' => 'sStreet'));
                $this->addTemplateReplaceVar(array('sVarname' => 'FieldNameZipCode', 'sReplace' => 'sZipCode'));
                $this->addTemplateReplaceVar(array('sVarname' => 'FieldNameLocale', 'sReplace' => 'sLocale'));
                $this->addTemplateReplaceVar(array('sVarname' => 'FieldNameCountry', 'sReplace' => 'sCountry'));

                $this->addTemplateReplaceVar(array('sVarname' => 'Username', 'sReplace' => $_sUsername));
                $this->addTemplateReplaceVar(array('sVarname' => 'Email', 'sReplace' => $_sEmail));
                $this->addTemplateReplaceVar(array('sVarname' => 'FirstName', 'sReplace' => $_sFirstName));
                $this->addTemplateReplaceVar(array('sVarname' => 'LastName', 'sReplace' => $_sLastName));
                $this->addTemplateReplaceVar(array('sVarname' => 'Street', 'sReplace' => $_sStreet));
                $this->addTemplateReplaceVar(array('sVarname' => 'ZipCode', 'sReplace' => $_sZipCode));
                $this->addTemplateReplaceVar(array('sVarname' => 'Locale', 'sReplace' => $_sLocale));
                $this->addTemplateReplaceVar(array('sVarname' => 'Country', 'sReplace' => $_sCountry));

                // TODO: Error Highlighting...
                // if (in_array('sUsername', $this->asRequiredFailed)) {$this->addTemplateReplaceVar(array('sVarname' => 'UsernameError', 'sReplace' => $_sErrorReasons));}
                // if (in_array('sEmail', $this->asRequiredFailed)) {$this->addTemplateReplaceVar(array('sVarname' => 'UsernameError', 'sReplace' => $_sErrorReasons));}

                if ($this->iMinCharCountUsername > 0) {$this->addTemplateReplaceVar(array('sVarname' => 'MinCharCountUsername', 'sReplace' => $this->iMinCharCountUsername));}
                if ($this->iMinCharCountPassword > 0) {$this->addTemplateReplaceVar(array('sVarname' => 'MinCharCountPassword', 'sReplace' => $this->iMinCharCountPassword));}

                // TODO: Captcha

                // PrivacyPolicy (Datenschutzerklärung)...
                $this->addTemplateReplaceVar(array('sVarname' => 'CheckboxNameAcceptPrivacyPolicy', 'sReplace' => 'iAcceptPrivacyPolicy'));
                $this->addTemplateReplaceVar(array('sVarname' => 'CheckboxTextAcceptPrivacyPolicy', 'sReplace' => str_replace('%sPrivacyPolicyUrl%', $this->sPrivacyPolicyUrl, $this->getText(array('sType' => 'AcceptPrivacyPolicy')))));

                // PrivacyTerms (Datenschutzrichtlinien)...
                $this->addTemplateReplaceVar(array('sVarname' => 'CheckboxNameAcceptPrivacyTerms', 'sReplace' => 'iAcceptPrivacyTerms'));
                $this->addTemplateReplaceVar(array('sVarname' => 'CheckboxTextAcceptPrivacyTerms', 'sReplace' => str_replace('%sPrivacyTermsUrl%', $this->sPrivacyTermsUrl, $this->getText(array('sType' => 'AcceptPrivacyTerms')))));

                // Terms of Use (Nutzungsbedingung)...
                $this->addTemplateReplaceVar(array('sVarname' => 'CheckboxNameAcceptTermsOfUse', 'sReplace' => 'iAcceptTermsOfUse'));
                $this->addTemplateReplaceVar(array('sVarname' => 'CheckboxTextAcceptTermsOfUse', 'sReplace' => str_replace('%sTermsOfUseUrl%', $this->sTermsOfUseUrl, $this->getText(array('sType' => 'AcceptTermsOfUse')))));

                // Terms and Conditions (AGB)...
                $this->addTemplateReplaceVar(array('sVarname' => 'CheckboxNameAcceptTermsAndConditions', 'sReplace' => 'iAcceptTermsAndConditions'));
                $this->addTemplateReplaceVar(array('sVarname' => 'CheckboxTextAcceptTermsAndConditions', 'sReplace' => str_replace('%sTermsAndConditionsUrl%', $this->sTermsAndConditionsUrl, $this->getText(array('sType' => 'AcceptTermsAndConditions')))));

                $_sSubmitButtonText = 'senden';
                if ($_bRegister == true) {$_sSubmitButtonText = $this->getText(array('sType' => 'AccountFormButtonRegisterText'));}
                else {$_sSubmitButtonText = $this->getText(array('sType' => 'AccountFormButtonEditText'));}

                $this->addTemplateReplaceVar(array('sVarname' => 'ButtonNameSubmit', 'sReplace' => 's'.$this->getID().'ButtonAccount'));
                $this->addTemplateReplaceVar(array('sVarname' => 'ButtonTextSubmit', 'sReplace' => $_sSubmitButtonText));

                $_sHtml .= $this->buildTemplate(
                    array(
                        'xTemplate' => $_xTemplate,
                        'bReplaceUrlProtocols' => NULL,
                        'bReplaceBBCode' => NULL,
                        'bReplaceDates' => NULL,
                        'bEncodeMails' => NULL
                    )
                );
            }
            else
            {
                $_sHtml .= $_sErrorReasons;
                if ((count($this->asRequiredFailed) > 0) && ($this->isAccountFormSubmitted()))
                {
                    $_sHtml .= '<span style="color:#ff0000;">';
                }
                $_sHtml .= 'Bitte f&uuml;llen Sie alle Pflichtfelder aus, die mit * gekennzeichnet sind.';
                if ((count($this->asRequiredFailed) > 0) && ($this->isAccountFormSubmitted()))
                {
                    $_sHtml .= '</span>';
                }
                $_sHtml .= '<br /><br />';

                $_sHtml .= '<form action="';
                if ($this->isUrlRewrite())
                {
                    if ($_bRegister == true) {$_sHtml .= $this->getText(array('sType' => 'RewriteUrlRegister'));}
                    else {$_sHtml .= $this->getText(array('sType' => 'RewriteUrlProfile'));}
                }
                else {$_sHtml .= $this->getUrl();}
                $_sHtml .= '" method="post" target="'.$this->getUrlTarget().'" style="text-align:center;" accept-charset="'.$this->sFormCharset.'" />';
                $_sHtml .= $this->getUrlParametersForm();
                $_sHtml .= '<input type="hidden" name="s'.$this->getID().'Account" value="';
                if ($_bRegister == true) {$_sHtml .= 'register';} else {$_sHtml .= 'edit';}
                $_sHtml .= '" />';
                $_sHtml .= '<input type="hidden" name="iUserID" value="'.$_iUserID.'" />';
                $_sHtml .= '<table align="center" style="border:0;">';

                // Username...
                if ($this->bEmailAsUsername == false)
                {
                    $_bRequired = false;
                    $_bFailed = false;
                    if (($_iUserID < 1) || ($this->bAllowChangeUsername == true)) {$_bRequired = true;}
                    if ($this->bAccountFormUserExistsError == true) {$_bFailed = true;}
                    else if ($this->isAccountFormSubmitted())
                    {
                        if (in_array('sUsername', $this->asRequiredFailed)) {$_bFailed = true;}
                    }
                    if ($this->bAccountFormUserMinCountError == true) {$_bFailed = true;}
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left; white-space:nowrap;">';
                            if ($_bFailed == true) {$_sHtml .= '<span style="color:#ff0000;">';}
                            $_sHtml .= $this->getText(array('sType' => 'Username'));
                            if ($this->bRequireUsername == true) {$_sHtml .= '  *';}
                            if ($_bFailed == true) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                        $_sHtml .= '<td>';
                            $_sHtml .= '<input type="text" ';
                            if (($_iUserID > 0) && ($_bAllowChangeUsername == false)) {$_sHtml .= 'disabled="disabled" ';}
                            $_sHtml .= 'name="sUsername" value="'.$_sUsername.'" />';
                        $_sHtml .= '</td>';
                        $_sHtml .= '<td>';
                            if ($this->iMinCharCountUsername > 0) {$_sHtml .= '(min. '.$this->iMinCharCountUsername.' Zeichen)';}
                        $_sHtml .= '</td>';
                    $_sHtml .= '</tr>';
                }

                // Email...
                $_bRequired = false;
                $_bFailed = false;
                if (($_iUserID < 1) || ($this->bAllowChangeEmail == true)) {$_bRequired = true;}
                if ($this->bAccountFormEmailExistsError == true) {$_bFailed = true;}
                else if ($this->isAccountFormSubmitted())
                {
                    for ($i=0; $i<count($this->asRequiredFailed); $i++)
                    {
                        if (($this->asRequiredFailed[$i] == 'sEmail') || ($this->asRequiredFailed[$i] == 'sEmailRetype')) {$_bFailed = true;}
                    }
                }
                if ($this->bAccountFormEmailSyntaxCheckOk == false) {$_bFailed = true;}
                $_sHtml .= '<tr>';
                    $_sHtml .= '<td style="text-align:left; white-space:nowrap;">';
                        if ($_bFailed == true) {$_sHtml .= '<span style="color:#ff0000;">';}
                        $_sHtml .= 'E-Mail';
                        if ($this->bRequireEmail == true) {$_sHtml .= ' *';}
                        if ($_bFailed == true) {$_sHtml .= '</span>';}
                    $_sHtml .= '</td>';
                    $_sHtml .= '<td>';
                        $_sHtml .= '<input type="text" ';
                        if (($_iUserID > 0) && ($_bAllowChangeEmail == false)) {$_sHtml .= 'disabled="disabled" ';}
                        $_sHtml .= 'name="sEmail" value="'.$_sEmail.'" />';
                    $_sHtml .= '</td>';
                    $_sHtml .= '<td></td>';
                $_sHtml .= '</tr>';
                if ($this->bAccountFormRequireEmailRetype == true)
                {
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left; white-space:nowrap;">';
                            if ($_bFailed == true) {$_sHtml .= '<span style="color:#ff0000;">';}
                            $_sHtml .= 'E-Mail wiederholen';
                            if ($this->bRequireEmail == true) {$_sHtml .= ' *';}
                            if ($_bFailed == true) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                        $_sHtml .= '<td>';
                            $_sHtml .= '<input type="text" ';
                            if (($_iUserID > 0) && ($_bAllowChangeEmail == false)) {$_sHtml .= 'disabled="disabled" ';}
                            $_sHtml .= 'name="sEmailRetype" value="'.$_sEmailRetype.'" />';
                        $_sHtml .= '</td>';
                        $_sHtml .= '<td></td>';
                    $_sHtml .= '</tr>';
                }

                // Password...
                if (($_bRegister == false) && ($_bPasswordRequired == true))
                {
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left; white-space:nowrap;">';
                        if ($this->isAccountFormSubmitted()) {$_sHtml .= '<span style="color:#ff0000;">';}
                        $_sHtml .= 'Altes Passwort *';
                        if ($this->isAccountFormSubmitted()) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                        $_sHtml .= '<td><input type="password" name="sOldPassword" value="" /></td>';
                    $_sHtml .= '</tr>';
                }
                if ($_bAutoGeneratePassword != true)
                {
                    // if ($this->isAccountFormSubmitted()) {$_bFailed = true;}
                    // if ($this->bAccountFormPasswordMinCountError == true) {$_bFailed = true;}
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left; white-space:nowrap;">';
                            if ($this->isAccountFormSubmitted()) {$_sHtml .= '<span style="color:#ff0000;">';}
                            $_sHtml .= 'Passwort';
                            if ($_bRegister == true) {$_sHtml .= ' *';}
                            if ($this->isAccountFormSubmitted()) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                        $_sHtml .= '<td><input type="password" name="sPassword" value="" /></td>';
                        $_sHtml .= '<td>';
                            if ($this->iMinCharCountPassword > 0) {$_sHtml .= '(min. '.$this->iMinCharCountPassword.' Zeichen)';}
                        $_sHtml .= '</td>';
                    $_sHtml .= '</tr>';
                    if ($this->bAccountFormRequirePasswordRetype == true)
                    {
                        $_sHtml .= '<tr>';
                            $_sHtml .= '<td style="text-align:left; white-space:nowrap;">';
                                if ($this->isAccountFormSubmitted()) {$_sHtml .= '<span style="color:#ff0000;">';}
                                $_sHtml .= 'Passwort wiederholen';
                                if ($_bRegister == true) {$_sHtml .= ' *';}
                                if ($this->isAccountFormSubmitted()) {$_sHtml .= '</span>';}
                            $_sHtml .= '</td>';
                            $_sHtml .= '<td><input type="password" name="sPasswordRetype" value="" /></td>';
                            $_sHtml .= '<td></td>';
                        $_sHtml .= '</tr>';
                    }
                }

                // FirstName...
                if (in_array('sFirstName', $this->asFieldsOnRegister))
                {
                    $_bRequired = false;
                    $_bFailed = false;
                    if (in_array('sFirstName', $this->asRequiredFailed))
                    {
                        $_bRequired = true;
                        if ($this->isAccountFormSubmitted()) {$_bFailed = true;}
                    }
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left; white-space:nowrap;">';
                            if ($_bFailed == true) {$_sHtml .= '<span style="color:#ff0000;">';}
                            $_sHtml .= $this->getText(array('sType' => 'FirstName'));
                            if ($_bRequired == true) {$_sHtml .= ' *';}
                            if ($_bFailed == true) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                        $_sHtml .= '<td><input type="text" name="sFirstName" value="'.$_sFirstName.'" /></td>';
                        $_sHtml .= '<td></td>';
                    $_sHtml .= '</tr>';
                }

                // LastName...
                if (in_array('sLastName', $this->asFieldsOnRegister))
                {
                    $_bRequired = false;
                    $_bFailed = false;
                    if (in_array('sLastName', $this->asRequiredFailed))
                    {
                        $_bRequired = true;
                        if ($this->isAccountFormSubmitted()) {$_bFailed = true;}
                    }
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left; white-space:nowrap;">';
                            if ($_bFailed == true) {$_sHtml .= '<span style="color:#ff0000;">';}
                            $_sHtml .= $this->getText(array('sType' => 'LastName'));
                            if ($_bRequired == true) {$_sHtml .= ' *';}
                            if ($_bFailed == true) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                        $_sHtml .= '<td><input type="text" name="sLastName" value="'.$_sLastName.'" /></td>';
                        $_sHtml .= '<td></td>';
                    $_sHtml .= '</tr>';
                }

                // Street...
                if (in_array('sStreet', $this->asFieldsOnRegister))
                {
                    $_bRequired = false;
                    $_bFailed = false;
                    if (in_array('sStreet', $this->asRequiredFailed))
                    {
                        $_bRequired = true;
                        if ($this->isAccountFormSubmitted()) {$_bFailed = true;}
                    }
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left; white-space:nowrap;">';
                            if ($_bFailed == true) {$_sHtml .= '<span style="color:#ff0000;">';}
                            $_sHtml .= 'Strasse';
                            if ($_bRequired == true) {$_sHtml .= ' *';}
                            if ($_bFailed == true) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                        $_sHtml .= '<td><input type="text" name="sStreet" value="'.$_sStreet.'" /></td>';
                        $_sHtml .= '<td></td>';
                    $_sHtml .= '</tr>';
                }

                // ZipCode...
                if (in_array('sZipCode', $this->asFieldsOnRegister))
                {
                    $_bRequired = false;
                    $_bFailed = false;
                    if (in_array('sZipCode', $this->asRequiredFailed))
                    {
                        $_bRequired = true;
                        if ($this->isAccountFormSubmitted()) {$_bFailed = true;}
                    }
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left; white-space:nowrap;">';
                            if ($_bFailed == true) {$_sHtml .= '<span style="color:#ff0000;">';}
                            $_sHtml .= 'PLZ';
                            if ($_bRequired == true) {$_sHtml .= ' *';}
                            if ($_bFailed == true) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                        $_sHtml .= '<td><input type="text" name="sZipCode" value="'.$_sZipCode.'" /></td>';
                        $_sHtml .= '<td></td>';
                    $_sHtml .= '</tr>';
                }

                // Locale...
                if (in_array('sLocale', $this->asFieldsOnRegister))
                {
                    $_bRequired = false;
                    $_bFailed = false;
                    if (in_array('sLocale', $this->asRequiredFailed))
                    {
                        $_bRequired = true;
                        if ($this->isAccountFormSubmitted()) {$_bFailed = true;}
                    }
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left; white-space:nowrap;">';
                            if ($_bFailed == true) {$_sHtml .= '<span style="color:#ff0000;">';}
                            $_sHtml .= 'Ort';
                            if ($_bRequired == true) {$_sHtml .= ' *';}
                            if ($_bFailed == true) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                        $_sHtml .= '<td><input type="text" name="sLocale" value="'.$_sLocale.'" /></td>';
                        $_sHtml .= '<td></td>';
                    $_sHtml .= '</tr>';
                }

                // Country...
                if (in_array('sCountry', $this->asFieldsOnRegister))
                {
                    $_bRequired = false;
                    $_bFailed = false;
                    if (in_array('sCountry', $this->asRequiredFailed))
                    {
                        $_bRequired = true;
                        if ($this->isAccountFormSubmitted()) {$_bFailed = true;}
                    }
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left; white-space:nowrap;">';
                            if ($_bFailed == true) {$_sHtml .= '<span style="color:#ff0000;">';}
                            $_sHtml .= 'Land';
                            if ($_bRequired == true) {$_sHtml .= ' *';}
                            if ($_bFailed == true) {$_sHtml .= '</span>';}
                            $_sHtml .= '</td>';
                        $_sHtml .= '<td><input type="text" name="sCountry" value="'.$_sCountry.'" /></td>';
                        $_sHtml .= '<td></td>';
                    $_sHtml .= '</tr>';
                }

                if ($this->bRegisterWithCaptcha == true)
                {
                    $_sHtml .= '<tr><td colspan="3">&nbsp;</td></tr>';
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left;" colspan="3">';
                            $_sHtml .= 'Aus Sicherheitsgr&uuml;nden tragen Sie bitte die folgenden Zeichen<br />in das Feld "Sicherheitscode" ein:';
                        $_sHtml .= '</td>';
                    $_sHtml .= '</tr>';
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left; white-space:nowrap;">Zeichenfolge</td>';
                        $_sHtml .= '<td style="text-align:center;">';
                            $_sHtml .= '<div id="'.$this->getID().'CaptchaImage"></div>';
                            $_sHtml .= '<a href="javascript:;" onclick="oPGLogin.loadCaptcha();" target="_self">neuen Code generieren</a>';
                        $_sHtml .= '</td>';
                    $_sHtml .= '</tr>';
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left; white-space:nowrap;">';
                            if ($this->bAccountFormCaptchaOk == false) {$_sHtml .= '<span style="color:#ff0000;">';}
                            $_sHtml .= 'Sicherheitscode *';
                            if ($this->bAccountFormCaptchaOk == false) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                        $_sHtml .= '<td>';
                            $_sHtml .= '<input type="text" name="sCaptchaInput" value="" />';
                            $_sHtml .= '<input type="hidden" id="'.$this->getID().'Captcha" name="sCaptcha" value="" />';
                            $_sHtml .= '<script type="text/javascript">';
                                $_sHtml .= 'if (typeof(oPGLogin) != "undefined") {oPGLogin.loadCaptcha();}';
                            $_sHtml .= '</script>';
                        $_sHtml .= '</td>';
                        $_sHtml .= '<td></td>';
                    $_sHtml .= '</tr>';
                }

                if
                (
                    ($this->sPrivacyPolicyUrl != '') || ($this->sPrivacyTermsUrl != '')
                    || ($this->sTermsOfUseUrl != '') || ($this->sTermsAndConditionsUrl != '')
                )
                {
                    $_sHtml .= '<tr><td colspan="2">&nbsp;</td></tr>';
                }

                // PrivacyPolicy (Datenschutzerklärung)...
                if ($this->sPrivacyPolicyUrl != '')
                {
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td colspan="3" style="text-align:left;">';
                        if ($_bRegister == true) {$_sHtml .= '<input type="checkbox" name="iAcceptPrivacyPolicy" value="1" /> ';}
                        if ($this->bAccountFormAcceptedPrivacyPolicy == false) {$_sHtml .= '<span style="color:#ff0000;">';}
                        $_sHtml .= str_replace('%sPrivacyPolicyUrl%', $this->sPrivacyPolicyUrl, $this->getText(array('sType' => 'AcceptPrivacyPolicy')));
                        if ($this->bAccountFormAcceptedPrivacyPolicy == false) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                    $_sHtml .= '</tr>';
                }

                // PrivacyTerms (Datenschutzrichtlinien)...
                if ($this->sPrivacyTermsUrl != '')
                {
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td colspan="3" style="text-align:left;">';
                        if ($_bRegister == true) {$_sHtml .= '<input type="checkbox" name="iAcceptPrivacyTerms" value="1" /> ';}
                        if ($this->bAccountFormAcceptedPrivacyTerms == false) {$_sHtml .= '<span style="color:#ff0000;">';}
                        $_sHtml .= str_replace('%sPrivacyTermsUrl%', $this->sPrivacyTermsUrl, $this->getText(array('sType' => 'AcceptPrivacyTerms')));
                        if ($this->bAccountFormAcceptedPrivacyTerms == false) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                    $_sHtml .= '</tr>';
                }

                // Terms of Use (Nutzungsbedingung)...
                if ($this->sTermsOfUseUrl != '')
                {
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td colspan="3" style="text-align:left;">';
                        if ($_bRegister == true) {$_sHtml .= '<input type="checkbox" name="iAcceptTermsOfUse" value="1" /> ';}
                        if ($this->bAccountFormAcceptedTermsOfUse == false) {$_sHtml .= '<span style="color:#ff0000;">';}
                        $_sHtml .= str_replace('%sTermsOfUseUrl%', $this->sTermsOfUseUrl, $this->getText(array('sType' => 'AcceptTermsOfUse')));
                        if ($this->bAccountFormAcceptedTermsOfUse == false) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                    $_sHtml .= '</tr>';
                }

                // Terms and Conditions (AGB)...
                if ($this->sTermsAndConditionsUrl != '')
                {
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td colspan="3" style="text-align:left;">';
                        if ($_bRegister == true) {$_sHtml .= '<input type="checkbox" name="iAcceptTermsAndConditions" value="1" /> ';}
                        if ($this->bAccountFormAcceptedTermsAndConditions == false) {$_sHtml .= '<span style="color:#ff0000;">';}
                        $_sHtml .= str_replace('%sTermsAndConditionsUrl%', $this->sTermsAndConditionsUrl, $this->getText(array('sType' => 'AcceptTermsAndConditions')));
                        if ($this->bAccountFormAcceptedTermsAndConditions == false) {$_sHtml .= '</span>';}
                        $_sHtml .= '</td>';
                    $_sHtml .= '</tr>';
                }

                $_sHtml .= '</table>';
                $_sHtml .= '<br />';
                $_sHtml .= '<input type="submit" class="button" name="s'.$this->getID().'ButtonAccount" value="';
                    if ($_bRegister == true) {$_sHtml .= $this->getText(array('sType' => 'AccountFormButtonRegisterText'));}
                    else {$_sHtml .= $this->getText(array('sType' => 'AccountFormButtonEditText'));}
                $_sHtml .= '" />';
                $_sHtml .= '</form>';
            }
        }
		
		return $_sHtml;
	}
	/* @end method */

	/*
	@start method
	
	@group Login
	
	@description
	[en]Builds the login form.[/en]
	[de]Erstellt das Anmeldeformular.[/de]
	
	@return sLoginFormHtml [type]string[/type]
	[en]Returns the login form as a string.[/en]
	[de]Gibt das Anmeldeformular als String zurück.[/de]
	
	@param iBuildType [type]int[/type]
	[en]
		The type / design of the login form.
		The following defines are possible:
		PG_LOGIN_BUILD_TYPE_LOGIN_NORMAL
		PG_LOGIN_BUILD_TYPE_LOGIN_BAR_TOP
		PG_LOGIN_BUILD_TYPE_LOGIN_BAR_BOTTOM
	[/en]
	[de]
		Der Typ / Aufbau des Anmeldeformulars.
		Folgende Defines sind möglich:
		PG_LOGIN_BUILD_TYPE_LOGIN_NORMAL
		PG_LOGIN_BUILD_TYPE_LOGIN_BAR_TOP
		PG_LOGIN_BUILD_TYPE_LOGIN_BAR_BOTTOM
	[/de]
	
	@param bFixedPosition [type]bool[/type]
	[en]Specifies whether the form should be fixed. This means it does not move when the page is scrolling.[/en]
	[de]Gibt an ob das Formular fixiert sein soll. Das heisst es bewegt sich beim Scrollen der Webseite nicht mit.[/de]
	*/
	public function buildLoginForm($_iBuildType = NULL, $_bFixedPosition = NULL, $_xTemplate = NULL)
	{
		global $_POST, $_SERVER, $_REQUEST;

		$_bFixedPosition = $this->getRealParameter(array('oParameters' => $_iBuildType, 'sName' => 'bFixedPosition', 'xParameter' => $_bFixedPosition));
        $_xTemplate = $this->getRealParameter(array('oParameters' => $_iBuildType, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));
		$_iBuildType = $this->getRealParameter(array('oParameters' => $_iBuildType, 'sName' => 'iBuildType', 'xParameter' => $_iBuildType));
		
		if ($_iBuildType === NULL) {$_iBuildType = PG_LOGIN_BUILD_TYPE_LOGIN_NORMAL;}
		if ($_bFixedPosition === NULL) {$_bFixedPosition = false;}
		
		if ($this->getUrl() == '') {$this->setUrl($_SERVER['PHP_SELF']);}
		if ($this->getUrl() == '') {$this->setUrl('index.php');}
		
		$_sUsername = '';
		if (isset($_REQUEST['s'.$this->getID().'Username'])) {$_sUsername = $_REQUEST['s'.$this->getID().'Username'];}
		
		$_sHtml = '';

        if (!empty($_xTemplate))
        {
            $this->addTemplateReplaceVar(array('sVarname' => 'FormUrl', 'sReplace' => $this->getUrl()));
            $this->addTemplateReplaceVar(array('sVarname' => 'FormTarget', 'sReplace' => $this->getUrlTarget()));
            $this->addTemplateReplaceVar(array('sVarname' => 'FormUrlParameters', 'sReplace' => $this->getUrlParametersForm()));

            $this->addTemplateReplaceVar(array('sVarname' => 'FieldNameUsername', 'sReplace' => 's'.$this->getID().'Username'));
            $this->addTemplateReplaceVar(array('sVarname' => 'FieldNamePassword', 'sReplace' => 's'.$this->getID().'Password'));

            $this->addTemplateReplaceVar(array('sVarname' => 'Username', 'sReplace' => $_sUsername));

            $this->addTemplateReplaceVar(array('sVarname' => 'ButtonNameLogin', 'sReplace' => $this->getID().'ButtonLogin'));
            $this->addTemplateReplaceVar(array('sVarname' => 'ButtonNameRegister', 'sReplace' => $this->getID().'ButtonRegister'));

            $this->addTemplateReplaceVar(array('sVarname' => 'ButtonTextLogin', 'sReplace' => $this->getText(array('sType' => 'ButtonLogin'))));
            $this->addTemplateReplaceVar(array('sVarname' => 'ButtonTextRegister', 'sReplace' => $this->getText(array('sType' => 'ButtonRegister'))));

            if ($this->bLoginFailed == true)
            {
                if ($this->bAccountNotAccepted == true) {$this->addTemplateReplaceVar(array('sVarname' => 'LoginErrorsMessage', 'sReplace' => str_replace('[email]', $this->axLoginData['Email'], $this->getText(array('sType' => 'LoginNotAcceptedErrorMessage')))));}
                else {$this->addTemplateReplaceVar(array('sVarname' => 'LoginErrorsMessage', 'sReplace' => $this->getText(array('sType' => 'LoginErrorsMessage'))));}
            }
            else {$this->addTemplateReplaceVar(array('sVarname' => 'LoginErrorsMessage', 'sReplace' => ''));}

            $this->addTemplateReplaceVar(array('sVarname' => 'NoAccountQuestion', 'sReplace' => $this->getText(array('sType' => 'NoAccountQuestion'))));
            $this->addTemplateReplaceVar(array('sVarname' => 'ForgotYourPasswordQuestion', 'sReplace' => $this->getText(array('sType' => 'ForgotYourPasswordQuestion'))));

            $_sHtml .= $this->buildTemplate(
                array(
                    'xTemplate' => $_xTemplate,
                    'bReplaceUrlProtocols' => NULL,
                    'bReplaceBBCode' => NULL,
                    'bReplaceDates' => NULL,
                    'bEncodeMails' => NULL
                )
            );
        }
        else
        {
            $_sHtml .= '<form action="';
            if ($this->isUrlRewrite()) {$_sHtml .= $this->getText(array('sType' => 'RewriteUrlLogin'));}
            else {$_sHtml .= $this->getUrl();}
            $_sHtml .= '" method="post" target="'.$this->getUrlTarget().'" accept-charset="'.$this->sFormCharset.'">';
            $_sHtml .= $this->getUrlParametersForm();

            switch($_iBuildType)
            {
                case PG_LOGIN_BUILD_TYPE_LOGIN_BAR_TOP:
                case PG_LOGIN_BUILD_TYPE_LOGIN_BAR_BOTTOM:
                    $_sHtml .= '<table align="center" style="';
                    if ($_bFixedPosition == true)
                    {
                        if ($_iBuildType == PG_LOGIN_BUILD_TYPE_BAR_TOP) {$_sHtml .= 'top:0px; ';}
                        else if ($_iBuildType == PG_LOGIN_BUILD_TYPE_LOGIN_BAR_BOTTOM) {$_sHtml .= 'botto:0px; ';}
                        $_sHtml .= 'position:fixed; ';
                    }
                    $_sHtml .= 'border:0; width:100%; z-index:9999999999;" cellpadding="0" cellspacing="0">';
                    if ($_iBuildType == PG_LOGIN_BUILD_TYPE_LOGIN_BAR_BOTTOM) {$_sHtml .= '<tr><td class="'.$this->getID().'Border"></td></tr>';}

                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td class="'.$this->getID().'Background">';

                        if ($this->isGuest())
                        {
                            $_sHtml .= '<table align="center" style="border-width:0px;" cellpadding="0" cellspacing="0">';
                            $_sHtml .= '<tr>';
                                // if ($this->bLoginFailed == true) {$_sHtml .= '<td>'.$this->getText(array('sType' => 'LoginErrorsMessage')).'</td><br />';}
                                $_sHtml .= '<td>';
                                    $_sHtml .= '<input type="text" id="'.$this->getID().'Field_Username" ';
                                    if ($this->bLoginFailed == true) {$_sHtml .= 'class="pg_login_inputfield_wrong_input" ';}
                                    else {$_sHtml .= 'class="pg_login_inputfield_normal" ';}
                                    $_sHtml .= 'name="s'.$this->getID().'Username" value="'.$_sUsername.'" />';
                                $_sHtml .= '</td>';
                                $_sHtml .= '<td>';
                                    $_sHtml .= '<input type="password" name="s'.$this->getID().'Password" ';
                                    if ($this->bLoginFailed == true) {$_sHtml .= 'class="pg_login_inputfield_wrong_input" ';}
                                    else {$_sHtml .= 'class="pg_login_inputfield_normal" ';}
                                    $_sHtml .= 'value="" />';
                                $_sHtml .= '</td>';
                                $_sHtml .= '<td>';
                                $_sHtml .= '<input type="submit" class="button" name="'.$this->getID().'ButtonLogin" value="'.$this->getText(array('sType' => 'ButtonLogin')).'" />';
                                $_sHtml .= '</td>';
                                if ($this->bAllowRegister == true)
                                {
                                    $_sHtml .= '<td>';
                                    $_sHtml .= '<input type="submit" class="button" name="'.$this->getID().'ButtonRegister" value="'.$this->getText(array('sType' => 'ButtonRegister')).'" />';
                                    $_sHtml .= '</td>';
                                }
                            $_sHtml .= '</tr>';
                            $_sHtml .= '</table>';
                        }
                        else
                        {
                            $_sHtml .= str_replace('[Username]', $this->axLoginData['Username'], $this->getText(array('sType' => 'LoggedInMessage')));
                        }

                        $_sHtml .= '</td>';
                    $_sHtml .= '</tr>';

                    if ($_iBuildType == PG_LOGIN_BUILD_TYPE_LOGIN_BAR_TOP) {$_sHtml .= '<tr><td class="'.$this->getID().'Border"></td></tr>';}
                    $_sHtml .= '</table>';
                    if ($_bFixedPosition == true) {$_sHtml .= '<div style="height:30px;"></div>';}
                break;

                case PG_LOGIN_BUILD_TYPE_LOGIN_NORMAL:
                default:
                    $_sHtml .= '<div class="'.$this->getID().'background">';
                    if ($this->bLoginFailed == true)
                    {
                        if ($this->bAccountNotAccepted == true)
                        {
                            $_sHtml .= str_replace('[email]', $this->axLoginData['Email'], $this->getText(array('sType' => 'LoginNotAcceptedErrorMessage')));
                        }
                        else {$_sHtml .= $this->getText(array('sType' => 'LoginErrorsMessage')).'<br />';}
                    }
                    $_sHtml .= '<table align="center" style="border-width:0px;">';
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left;">'.$this->getText(array('sType' => 'Username')).'</td>';
                        $_sHtml .= '<td>';
                            $_sHtml .= '<input type="text" id="'.$this->getID().'Field_Username" ';
                            if ($this->bLoginFailed == true) {$_sHtml .= 'class="pg_login_inputfield_wrong_input" ';}
                            else {$_sHtml .= 'class="pg_login_inputfield_normal" ';}
                            $_sHtml .= 'name="s'.$this->getID().'Username" value="'.$_sUsername.'" />';
                        $_sHtml .= '</td>';
                    $_sHtml .= '</tr>';
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td style="text-align:left;">Passwort</td>';
                        $_sHtml .= '<td>';
                            $_sHtml .= '<input type="password" name="s'.$this->getID().'Password" ';
                            if ($this->bLoginFailed == true) {$_sHtml .= 'class="pg_login_inputfield_wrong_input" ';}
                            else {$_sHtml .= 'class="pg_login_inputfield_normal" ';}
                            $_sHtml .= 'value="" />';
                        $_sHtml .= '</td>';
                    $_sHtml .= '</tr>';
                    $_sHtml .= '<tr><td colspan="2" style="height:20px;">&nbsp;</td></tr>';
                    $_sHtml .= '<tr>';
                        $_sHtml .= '<td colspan="2" style="text-align:center;">';
                        $_sHtml .= '<input type="submit" class="button" name="'.$this->getID().'ButtonLogin" value="'.$this->getText(array('sType' => 'ButtonLogin')).'" onclick="oPGLogin.loginButtonOnClick();" />';
                        if (($this->bAllowRegister == true) && ($this->bUseRegisterButton == true))
                        {
                            $_sHtml .= ' ';
                            $_sHtml .= '<input type="submit" class="button" name="'.$this->getID().'ButtonRegister" value="'.$this->getText(array('sType' => 'ButtonRegister')).'" />';
                        }
                        $_sHtml .= '</td>';
                    $_sHtml .= '</tr>';
                    $_sHtml .= '</table>';
                    $_sHtml .= '</div>';
            }
            $_sHtml .= '</form>';
            if ($_iBuildType == PG_LOGIN_BUILD_TYPE_LOGIN_NORMAL)
            {
                if (($this->bAllowRegister == true) && ($this->getText(array('sType' => 'NoAccountQuestion')) != ''))
                {
                    $_sHtml .= '<br /><br />'.$this->getText(array('sType' => 'NoAccountQuestion'));
                }
                if (($this->bAllowPasswordReset == true) && ($this->getText(array('sType' => 'ForgotYourPasswordQuestion')) != ''))
                {
                    $_sHtml .= '<br /><br />'.$this->getText(array('sType' => 'ForgotYourPasswordQuestion'));
                }
            }
        }

		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds a panel with action possibilities to the user account.[/en]
	[de]Erstellt ein Panel mit Aktionsmöglichkeiten zum Benutzerkonto.[/de]
	
	@return sPanelHtml [type]string[/type]
	[en]Returns the panel as a string.[/en]
	[de]Gibt das Panel als String zurück.[/de]
	*/
	public function buildUserControlPanel()
	{
		$_sParameters = $this->getUrlParametersString();
		if ($_sParameters != '') {$_sParameters = '&'.$_sParameters;}
	
		$_sHtml = '';
		$_sHtml .= 'Hallo ';
		if (!$this->isGuest()) {$_sHtml .= $this->axLoginData['Username'];}
		else {$_sHtml .= 'guest';}
		$_sHtml .= ' (';
		$_sHtml .= '<a href="'.$this->getUrl().'?sPGAccount='.PG_LOGIN_BUILD_TYPE_ACCOUNT_EDIT.$_sParameters.'" target="'.$this->getUrlTarget().'">Einstellungen</a> | ';
		$_sHtml .= '<a href="'.$this->getUrl().'?iPGLogout=1'.$_sParameters.'" target="'.$this->getUrlTarget().'">logout</a>)';
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the build type for the login system, the visitor would like to call.[/en]
	[de]Gibt den Aufbautyp für das Login-System zurück, den der Seitenbesucher aufrufen möchte.[/de]
	
	@return iBuildType [type]int[/type]
	[en]Returns the build type for the login system, the visitor would like to call.[/en]
	[de]Gibt den Aufbautyp für das Login-System zurück, den der Seitenbesucher aufrufen möchte.[/de]
	*/
	public function getBuildTypeReceived()
	{
		global $_REQUEST, $_POST;
		
		$_iBuildType = -1;
		if (isset($_POST[$this->getID().'ButtonRegister']))
		{
			if ($_POST[$this->getID().'ButtonRegister'] == $this->getText(array('sType' => 'ButtonRegister'))) {$_iBuildType = PG_LOGIN_BUILD_TYPE_ACCOUNT_REGISTER;}
		}
		
		if (isset($_POST['s'.$this->getID().'ButtonAccount']))
		{
			if (($_POST['s'.$this->getID().'ButtonAccount'] == $this->getText(array('sType' => 'AccountFormButtonRegisterText')))
            || ($_POST['s'.$this->getID().'ButtonAccount'] == $this->getText(array('sType' => 'AccountFormButtonRegisterText'))))
			{
				if (($_POST['s'.$this->getID().'Account'] == 'register') && ($this->bAllowRegister == true)) {$_iBuildType = PG_LOGIN_BUILD_TYPE_ACCOUNT_REGISTER;}
				else if (($_POST['s'.$this->getID().'Account'] == 'edit') && (!$this->isGuest())) {$_iBuildType = PG_LOGIN_BUILD_TYPE_ACCOUNT_EDIT;}
			}
		}
		
		if (isset($_REQUEST['sPGAccount']))
		{
			if ((($_REQUEST['sPGAccount'] == 'register') || ($_REQUEST['sPGAccount'] == PG_LOGIN_BUILD_TYPE_ACCOUNT_REGISTER)) && ($this->bAllowRegister == true)) {$_iBuildType = PG_LOGIN_BUILD_TYPE_ACCOUNT_REGISTER;}
			else if ((($_REQUEST['sPGAccount'] == 'edit') || ($_REQUEST['sPGAccount'] == PG_LOGIN_BUILD_TYPE_ACCOUNT_EDIT)) && (!$this->isGuest())) {$_iBuildType = PG_LOGIN_BUILD_TYPE_ACCOUNT_EDIT;}
			else if ((($_REQUEST['sPGAccount'] == 'password_reset') || ($_REQUEST['sPGAccount'] == PG_LOGIN_BUILD_TYPE_ACCOUNT_RESET_PASSWORD)) && ($this->bAllowPasswordReset == true)) {$_iBuildType = PG_LOGIN_BUILD_TYPE_ACCOUNT_RESET_PASSWORD;}
			else if (($_REQUEST['sPGAccount'] == 'accept_account') || ($_REQUEST['sPGAccount'] == PG_LOGIN_BUILD_TYPE_ACCOUNT_ACCEPT)) {$_iBuildType = PG_LOGIN_BUILD_TYPE_ACCOUNT_ACCEPT;}
			else if (($_REQUEST['sPGAccount'] == 'login') || ($_REQUEST['sPGAccount'] == PG_LOGIN_BUILD_TYPE_LOGIN_NORMAL)) {$_iBuildType = PG_LOGIN_BUILD_TYPE_LOGIN_NORMAL;}
            // else if (($_REQUEST['sPGAccount'] == 'resend_accept_email') || ($_REQUEST['sPGAccount'] == PG_LOGIN_BUILD_TYPE_RESEND_ACCEPT_EMAIL)) {$_iBuildType = PG_LOGIN_BUILD_TYPE_RESEND_ACCEPT_EMAIL;}
            else {$_iBuildType = PG_LOGIN_BUILD_TYPE_LOGIN_NORMAL;}
		}
		if ($_iBuildType == -1) {$_iBuildType = $this->iDefaultBuildType;}
		return $_iBuildType;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds an HTML string for the login system and returns it.[/en]
	[de]Erstellt einen HTML String für das Login-System und gibt diesen zurück.[/de]
	
	@return sLoginHtml [type]string[/type]
	[en]Returns the HTML string.[/en]
	[de]Gibt den HTML String zurück.[/de]
	
	@param iBuildType [type]int[/type]
	[en]
		The type / design of the login form or of the registration and changing form.
		The following defines are possible:
		PG_LOGIN_BUILD_TYPE_LOGIN_NORMAL
		PG_LOGIN_BUILD_TYPE_LOGIN_BAR_TOP
		PG_LOGIN_BUILD_TYPE_LOGIN_BAR_BOTTOM
		PG_LOGIN_BUILD_TYPE_ACCOUNT_REGISTER
		PG_LOGIN_BUILD_TYPE_ACCOUNT_EDIT
		PG_LOGIN_BUILD_TYPE_ACCOUNT_RESET_PASSWORD
		PG_LOGIN_BUILD_TYPE_ACCOUNT_ACCEPT
	[/en]
	[de]
		Der Typ / Aufbau des Anmeldeformulars oder des Registrations- und änderungsformulars.
		Folgende Defines sind möglich:
		PG_LOGIN_BUILD_TYPE_LOGIN_NORMAL
		PG_LOGIN_BUILD_TYPE_LOGIN_BAR_TOP
		PG_LOGIN_BUILD_TYPE_LOGIN_BAR_BOTTOM
		PG_LOGIN_BUILD_TYPE_ACCOUNT_REGISTER
		PG_LOGIN_BUILD_TYPE_ACCOUNT_EDIT
		PG_LOGIN_BUILD_TYPE_ACCOUNT_RESET_PASSWORD
		PG_LOGIN_BUILD_TYPE_ACCOUNT_ACCEPT
	[/de]
	
	@param bFixedPosition [type]bool[/type]
	[en]Specifies whether the form should be fixed. This means it does not move when the page is scrolling.[/en]
	[de]Gibt an ob das Formular fixiert sein soll. Das heisst es bewegt sich beim Scrollen der Webseite nicht mit.[/de]
	
	@param asRequired [type]string[][/type]
	[en]The required fields that you want to have completed.[/en]
	[de]Die Pflichtfelder, die man ausgefüllt haben möchte.[/de]
	
	@param bPasswordRequired [type]bool[/type]
	[en]Specifies whether the password is a required field when you modify existing users.[/en]
	[de]Gibt an ob beim ändern von vorhandenen Benutzern das Passwort (altes Passwort) ein Pflichtfeld ist.[/de]
	*/
	public function build(
        $_iBuildType = NULL,
        $_bFixedPosition = NULL,
        $_asRequired = NULL,
        $_bPasswordRequired = NULL,
        $_xLoginFormTemplate = NULL,
        $_xAccountFormTemplate = NULL,
        $_xPasswordResetFormTemplate = NULL,
        $_bSendMailWithPassword = NULL
    )
	{
		global $_REQUEST;

		$_bFixedPosition = $this->getRealParameter(array('oParameters' => $_iBuildType, 'sName' => 'bFixedPosition', 'xParameter' => $_bFixedPosition));
		$_asRequired = $this->getRealParameter(array('oParameters' => $_iBuildType, 'sName' => 'asRequired', 'xParameter' => $_asRequired));
		$_bPasswordRequired = $this->getRealParameter(array('oParameters' => $_iBuildType, 'sName' => 'bPasswordRequired', 'xParameter' => $_bPasswordRequired));
        $_xLoginFormTemplate = $this->getRealParameter(array('oParameters' => $_iBuildType, 'sName' => 'xLoginFormTemplate', 'xParameter' => $_xLoginFormTemplate));
        $_xAccountFormTemplate = $this->getRealParameter(array('oParameters' => $_iBuildType, 'sName' => 'xAccountFormTemplate', 'xParameter' => $_xAccountFormTemplate));
        $_xPasswordResetFormTemplate = $this->getRealParameter(array('oParameters' => $_iBuildType, 'sName' => 'xPasswordResetFormTemplate', 'xParameter' => $_xPasswordResetFormTemplate));
        $_bSendMailWithPassword = $this->getRealParameter(array('oParameters' => $_iBuildType, 'sName' => 'bSendMailWithPassword', 'xParameter' => $_bSendMailWithPassword));
		$_iBuildType = $this->getRealParameter(array('oParameters' => $_iBuildType, 'sName' => 'iBuildType', 'xParameter' => $_iBuildType));
		
		if ($_iBuildType === NULL) {$_iBuildType = $this->getBuildTypeReceived();}
		if ($_asRequired === NULL) {$_asRequired = $this->asRequired;}
		if ($_bPasswordRequired === NULL) {$_bPasswordRequired = false;}

		$_sSecureCode = '';
		$_sUsername = '';
		$_sEmail = '';
		
		if (isset($_REQUEST['sSecureCode'])) {$_sSecureCode = $_REQUEST['sSecureCode'];}
		if (isset($_REQUEST['sUsername'])) {$_sUsername = $_REQUEST['sUsername'];}
		if (isset($_REQUEST['sEmail'])) {$_sEmail = $_REQUEST['sEmail'];}

		$bRegister = false;
		if ($this->isGuest()) {$bRegister = true; $_bPasswordRequired = true;}
		
		$_sHtml = '';

        if (!empty($_REQUEST['resend_accept_mail']))
        {
            if (
                $_oResult = $this->selectDatasets(
                    array(
                        'sTable' => $this->getDatabaseTablePrefix().'user',
                        'xWhere' => array('Email' => $_REQUEST['email']),
                        'iCount' => 1
                    )
                )
            )
            {
                if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
                {
                    $this->sendAccountAcceptMail(array('xSendToMail' => $_axUser['Email'], 'sUsername' => $_axUser['Username'], 'sPassword' => NULL));
                }
            } // if _oResult
        }

		if (($_iBuildType == PG_LOGIN_BUILD_TYPE_ACCOUNT_RESET_PASSWORD) && ($this->bAllowPasswordReset == true))
		{
			if ((($_sEmail != '') || ($_sUsername != '')) && ($_sSecureCode != '')) {$_sHtml .= $this->buildAcceptPasswordReset(array('sEmail' => $_sEmail, 'sUsername' => $_sUsername, 'sSecureCode' => $_sSecureCode));}
			else if (($_sEmail != '') || ($_sUsername != '')) {$_sHtml .= $this->buildRequestPasswordReset(array('sEmail' => $_sEmail, 'sUsername' => $_sUsername));}
			else {$_sHtml .= $this->buildPasswordResetForm(array('xTemplate' => $_xPasswordResetFormTemplate));}
		}
		else if (($_iBuildType == PG_LOGIN_BUILD_TYPE_ACCOUNT_ACCEPT) && ($_sSecureCode != '') && (($_sUsername != '') || ($_sEmail != ''))) {$_sHtml .= $this->buildAcceptUser(array('sSecureCode' => $_sSecureCode, 'sEmail' => $_sEmail, 'sUsername' => $_sUsername));}
		else if (($_iBuildType == PG_LOGIN_BUILD_TYPE_ACCOUNT_REGISTER) || (!$this->isGuest())) {$_sHtml .= $this->buildAccountForm(array('bRegister' => $bRegister, 'iUserID' => NULL, 'asRequired' => $_asRequired, 'bPasswordRequired' => $_bPasswordRequired, 'xTemplate' => $_xAccountFormTemplate, 'bSendMailWithPassword' => $_bSendMailWithPassword));}
		else {$_sHtml .= $this->buildLoginForm(array('iBuildType' => $_iBuildType, 'bFixedPosition' => $_bFixedPosition, 'xTemplate' => $_xLoginFormTemplate));}
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGLogin = new classPG_Login();

if (defined('PG_LOGIN_GLOBAL_URL_PATH')) {$oPGLogin->setLoginGlobalUrl(array('sUrl' => PG_LOGIN_GLOBAL_URL_PATH));}
if (defined('PG_LOGIN_PASSWORD_RESET_ACCEPT_FILE_PATH')) {$oPGLogin->setPasswordResetAcceptFilePath(array('sFile' => PG_LOGIN_PASSWORD_RESET_ACCEPT_FILE_PATH));}
if (defined('PG_LOGIN_ACCOUNT_ACCEPT_FILE_PATH')) {$oPGLogin->setAccountAcceptFilePath(array('sFile' => PG_LOGIN_ACCOUNT_ACCEPT_FILE_PATH));}
if (defined('PG_LOGIN_SYSTEM_EMAIL')) {$oPGLogin->setSystemEmail(array('sEmail' => PG_LOGIN_SYSTEM_EMAIL));}
if (defined('PG_LOGIN_SYSTEM_TITLE')) {$oPGLogin->setSystemTitle(array('sTitle' => PG_LOGIN_SYSTEM_TITLE));}

if (defined('PG_LOGIN_DATABASE_HOST')) {$oPGLogin->setDatabaseHost(array('sHost' => PG_LOGIN_DATABASE_HOST, 'sEngine' => PG_DATABASE_ENGINE_ALL));}
if (defined('PG_LOGIN_DATABASE_USER')) {$oPGLogin->setDatabaseUser(array('sUser' => PG_LOGIN_DATABASE_USER, 'sEngine' => PG_DATABASE_ENGINE_ALL));}
if (defined('PG_LOGIN_DATABASE_PASSWORD')) {$oPGLogin->setDatabasePassword(array('sPassword' => PG_LOGIN_DATABASE_PASSWORD, 'sEngine' => PG_DATABASE_ENGINE_ALL));}
if (defined('PG_LOGIN_DATABASE_DATABASE')) {$oPGLogin->setDatabaseDBName(array('sDatabase' => PG_LOGIN_DATABASE_DATABASE, 'sEngine' => PG_DATABASE_ENGINE_ALL));}
if (defined('PG_LOGIN_DATABASE_TABLE_PREFIX')) {$oPGLogin->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_DATABASE_TABLE_PREFIX));}

if (defined('PG_LOGIN_MYSQL_HOST')) {$oPGLogin->setDatabaseHost(array('sHost' => PG_LOGIN_MYSQL_HOST, 'sEngine' => PG_DATABASE_ENGINE_MYSQL));}
if (defined('PG_LOGIN_MYSQL_USER')) {$oPGLogin->setDatabaseUser(array('sUser' => PG_LOGIN_MYSQL_USER, 'sEngine' => PG_DATABASE_ENGINE_MYSQL));}
if (defined('PG_LOGIN_MYSQL_PASSWORD')) {$oPGLogin->setDatabasePassword(array('sPassword' => PG_LOGIN_MYSQL_PASSWORD, 'sEngine' => PG_DATABASE_ENGINE_MYSQL));}
if (defined('PG_LOGIN_MYSQL_DATABASE')) {$oPGLogin->setDatabaseDBName(array('sDatabase' => PG_LOGIN_MYSQL_DATABASE, 'sEngine' => PG_DATABASE_ENGINE_MYSQL));}
if (defined('PG_LOGIN_MYSQL_TABLE_PREFIX')) {$oPGLogin->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_MYSQL_TABLE_PREFIX));}

if (defined('PG_LOGIN_MSSQL_HOST')) {$oPGLogin->setDatabaseHost(array('sHost' => PG_LOGIN_MSSQL_HOST, 'sEngine' => PG_DATABASE_ENGINE_MSSQL));}
if (defined('PG_LOGIN_MSSQL_USER')) {$oPGLogin->setDatabaseUser(array('sUser' => PG_LOGIN_MSSQL_USER, 'sEngine' => PG_DATABASE_ENGINE_MSSQL));}
if (defined('PG_LOGIN_MSSQL_PASSWORD')) {$oPGLogin->setDatabasePassword(array('sPassword' => PG_LOGIN_MSSQL_PASSWORD, 'sEngine' => PG_DATABASE_ENGINE_MSSQL));}
if (defined('PG_LOGIN_MSSQL_DATABASE')) {$oPGLogin->setDatabaseDBName(array('sDatabase' => PG_LOGIN_MSSQL_DATABASE, 'sEngine' => PG_DATABASE_ENGINE_MSSQL));}
if (defined('PG_LOGIN_MSSQL_TABLE_PREFIX')) {$oPGLogin->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_MSSQL_TABLE_PREFIX));}

if (defined('PG_LOGIN_MONGO_HOST')) {$oPGLogin->setDatabaseHost(array('sHost' => PG_LOGIN_MONGO_HOST, 'sEngine' => PG_DATABASE_ENGINE_MONGO));}
if (defined('PG_LOGIN_MONGO_USER')) {$oPGLogin->setDatabaseUser(array('sUser' => PG_LOGIN_MONGO_USER, 'sEngine' => PG_DATABASE_ENGINE_MONGO));}
if (defined('PG_LOGIN_MONGO_PASSWORD')) {$oPGLogin->setDatabasePassword(array('sPassword' => PG_LOGIN_MONGO_PASSWORD, 'sEngine' => PG_DATABASE_ENGINE_MONGO));}
if (defined('PG_LOGIN_MONGO_DATABASE')) {$oPGLogin->setDatabaseDBName(array('sDatabase' => PG_LOGIN_MONGO_DATABASE, 'sEngine' => PG_DATABASE_ENGINE_MONGO));}
if (defined('PG_LOGIN_MONGO_TABLE_PREFIX')) {$oPGLogin->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_MONGO_TABLE_PREFIX));}

if (defined('PG_LOGIN_SECRET_KEY_1')) {$oPGLogin->setSecretKey1(array('sKey' => PG_LOGIN_SECRET_KEY_1));}
if (defined('PG_LOGIN_SECRET_KEY_2')) {$oPGLogin->setSecretKey2(array('sKey' => PG_LOGIN_SECRET_KEY_2));}
if (defined('PG_LOGIN_SECRET_KEY_3')) {$oPGLogin->setSecretKey3(array('sKey' => PG_LOGIN_SECRET_KEY_3));}
if (defined('PG_LOGIN_SECRET_KEY_4')) {$oPGLogin->setSecretKey4(array('sKey' => PG_LOGIN_SECRET_KEY_4));}
if (defined('PG_LOGIN_SECRET_KEY_5')) {$oPGLogin->setSecretKey5(array('sKey' => PG_LOGIN_SECRET_KEY_5));}

if (defined('PG_LOGIN_COOKIE_NAME')) {$oPGLogin->setCookieName(array('sName' => PG_LOGIN_COOKIE_NAME));}
if (defined('PG_LOGIN_COOKIE_TIME')) {$oPGLogin->setCookieTime(array('iSeconds' => PG_LOGIN_COOKIE_TIME));}
if (defined('PG_LOGIN_COOKIE_PATH')) {$oPGLogin->setCookiePath(array('sPath' => PG_LOGIN_COOKIE_PATH));}
if (defined('PG_LOGIN_COOKIE_DOMAIN')) {$oPGLogin->setCookieDomain(array('sDomain' => PG_LOGIN_COOKIE_DOMAIN));}
if (defined('PG_LOGIN_COOKIE_SECURE')) {$oPGLogin->useCookieSecure(array('bSecure' => (bool)PG_LOGIN_COOKIE_SECURE));}

if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGLogin', 'xValue' => $oPGLogin));}
?>