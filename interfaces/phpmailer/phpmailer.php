<?php
class classPG_PhpMailer extends classPG_ClassBasics
{
    // Declarations...
    private $oMailer = NULL;
    private $sHost = '';
    private $sFromMail = '';
    private $sFromName = '';
    private $sUsername = '';
    private $sPassword = '';
    private $sSmtpSecure = 'tls';
    private $bUseSmtpAuth = true;
    private $iWordWrap = 50;
    private $bUseHtml = true;

    // Construct...
    public function __construct()
    {
        $this->init();
        $this->initTemplate();
    }

    // Methods...
    public function init()
    {
        if (class_exists('PHPMailer'))
        {
            $this->oMailer = new PHPMailer();
        }
    }

    public function setHost($_sHost)
    {
        $_sHost = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sHost', 'xParameter' => $_sHost));
        $this->sHost = $_sHost;
    }

    public function setFrom($_sFromMail, $_sFromName = NULL)
    {
        $_sFromName = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sFromName', 'xParameter' => $_sFromName));
        $_sFromMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sFromMail', 'xParameter' => $_sFromMail));
        $this->sFromMail = $_sFromMail;
        $this->sFromName = $_sFromName;
    }

    public function setUsername($_sUsername)
    {
        $_sUsername = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
        $this->sUsername = $_sUsername;
    }

    public function setPassword($_sPassword)
    {
        $_sPassword = $this->getRealParameter(array('oParameters' => $_sPassword, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
        $this->sPassword = $_sPassword;
    }

    public function setSmtpSecure($_sSecure)
    {
        $_sSecure = $this->getRealParameter(array('oParameters' => $_sSecure, 'sName' => 'sSecure', 'xParameter' => $_sSecure));
        $this->sSmtpSecure = $_sSecure;
    }

    public function send($_sFromMail = NULL, $_xToMail = NULL, $_sSubject = NULL, $_sMessage = NULL, $_asAttachment = NULL, $_bHtml = NULL, $_bText = NULL, $_xTemplate = NULL)
    {
        global $oPGStrings;

        $_xToMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'xToMail', 'xParameter' => $_xToMail));
        $_sSubject = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sSubject', 'xParameter' => $_sSubject));
        $_sMessage = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		$_asAttachment = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'asAttachment', 'xParameter' => $_asAttachment));
        $_bHtml = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'bHtml', 'xParameter' => $_bHtml));
        $_bText = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'bText', 'xParameter' => $_bText));
        $_xTemplate = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));
        $_sFromMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sFromMail', 'xParameter' => $_sFromMail));

        if ($_bHtml === NULL) {$_bHtml = $this->bUseHtml;}
        if ($_sFromMail === NULL) {$_sFromMail = $this->sFromMail;}

        $this->oMailer->isSMTP();
        $this->oMailer->CharSet = strtolower('UTF-8');
        $this->oMailer->Host = $this->sHost;
        $this->oMailer->SMTPAuth = $this->bUseSmtpAuth;
        $this->oMailer->Username = $this->sUsername;
        $this->oMailer->Password = $this->sPassword;
        $this->oMailer->SMTPSecure = $this->sSmtpSecure;

        $this->oMailer->From = $_sFromMail;
        if ($this->sFromName != '') {$this->oMailer->FromName = $this->sFromName;}

        $this->oMailer->clearAddresses();
        if (is_string($_xToMail)) {$this->oMailer->addAddress($_xToMail);}
        else if (is_array($_xToMail))
        {
            for ($i=0; $i<count($_xToMail); $i++)
            {
                $this->oMailer->addAddress($_xToMail[$i]);
            }
        }

        $this->oMailer->WordWrap = $this->iWordWrap;
        if ($_bHtml !== NULL) {$this->oMailer->isHtml($_bHtml);}

		if ($_asAttachment !== NULL)
		{
			foreach ($_asAttachment as $_iIndex => $_sAttachment)
			{
				$this->oMailer->AddAttachment($_sAttachment);
			}
		}

        if (!empty($_xTemplate))
        {
            if (!empty($_sMessage))
            {
                $this->addTemplateReplaceVar(array('sVarname' => 'message', 'sReplace' => $_sMessage));
            }

            $_sMessage = $this->buildTemplate(
                array(
                    'xTemplate' => $_xTemplate,
                    'bReplaceUrlProtocols' => NULL,
                    'bReplaceBBCode' => NULL,
                    'bReplaceDates' => NULL,
                    'bEncodeMails' => NULL
                )
            );
        }

        $this->oMailer->Subject = $_sSubject;
        $this->oMailer->Body = $_sMessage;
        if ($_bText == true)
        {
            $this->oMailer->AltBody = stripslashes($oPGStrings->removeHTML($oPGStrings->htmlToText($_sMessage)));
        }

        return $this->oMailer->send();
    }
}
$oPGPhpMailer = new classPG_PhpMailer();
?>