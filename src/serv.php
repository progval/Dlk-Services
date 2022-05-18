<?php
/*				
//	(C) 2021 DalekIRC Services
\\				
//			pathweb.org
\\				
//	GNU GENERAL PUBLIC LICENSE
\\				v3
//				
\\				
//				
\\	Title:		Protocol
//				
\\	Desc:		Class for the server itself which hold functions
//				which use the IRC protocol.
\\				
<<<<<<< HEAD
//
\\
=======
//				
\\				
>>>>>>> 1d6af964a27a04cb46dafb3c58b0c93538e7352a
//				
\\	Version:	1
//				
\\	Author:		Valware
//				
*/




class Server
{
	
	function __construct($server,$port,$password)
	{
				
		// INITIALISING CONNECT SEQUENCE lmao
		$this->connect($server,$port,$password);
	
	}
	private function connect($server,$port,$password)
	{
		
		// Declare de globals;
<<<<<<< HEAD
		global $socket,$nickserv,$chanserv,$botserv,$operserv,$hostserv,$servertime,$cf;
=======
		global $socket,$nickserv,$chanserv,$botserv,$operserv,$hostserv,$servertime,$svs,$cf;
>>>>>>> 1d6af964a27a04cb46dafb3c58b0c93538e7352a
		
		// Anything we wanna initialise before we connect
		
		$this->sid = $cf['sid'];
		$this->name = $cf['servicesname'];
		/* pre connect shit */
		
		// we are disabling verification for now until built upon more :>
		// create ssl context
		$context = stream_context_create(['ssl' => [
<<<<<<< HEAD
			'verify_peer'  => true,
			'verify_peer_name'  => true,
=======
			'verify_peer'  => false,
			'verify_peer_name'  => false,
>>>>>>> 1d6af964a27a04cb46dafb3c58b0c93538e7352a
			'allow_self_signed' => true,
			'ciphers' => 'ECDHE-ECDSA-AES256-GCM-SHA384'
		]]);

		//opening socket YO
		$socket = stream_socket_client($server.':'.$port, $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $context);
		
		
		
		
		$this->sendraw("PASS $password");
		$this->sendraw("PROTOCTL EAUTH=".$cf['servicesname'].",6000 SID=".$cf['sid']);
<<<<<<< HEAD
		$this->sendraw("PROTOCTL NOQUIT NICKv2 SJOIN SJOIN2 SJ3 CLK TKLEXT2 NICKIP ESVID MLOCK NEXTBANS EXTSWHOIS SJSBY MTAGS");
		$this->sendraw("SERVER ".$cf['servicesname']." 1 :Dalek IRC Services");
		$this->sendraw("MD client ".$cf['sid']." saslmechlist :PLAIN,EXTERNAL");
		$this->sendraw("MD client ".$cf['sid']." externalreglink :https://valware.uk/register");
		$this->sendraw("MD client ".$cf['sid']." regkeylist :before-connect,email-required,custom-account-name");
		$this->sendraw("EOS");
=======
		$this->sendraw("PROTOCTL NOQUIT NICKv2 SJOIN SJOIN2 SJ3 CLK TKLEXT2 NICKIP ESVID MLOCK NEXTBANS EXTSWHOIS SJSBY");
		$this->sendraw("SERVER ".$cf['servicesname']." 1 :Dalek IRC Services");
		$this->sendraw("EOS");
		$this->sendraw("MD client ".$cf['sid']." saslmechlist :PLAIN,EXTERNAL");
>>>>>>> 1d6af964a27a04cb46dafb3c58b0c93538e7352a
		

	}
	function svs2mode($nick,$string)
	{
		
		if (!($nick = find_person($nick))){ return; }
		
		$uid = $nick['UID'];
		
		$this->sendraw(":$this->sid SVS2MODE $uid $string");
	}
	function sendraw($string)
	{
		// Declare de globals;
<<<<<<< HEAD
		global $socket,$cf;
		if ($cf['debugmode'] == "on")
			echo "[\e[0;30;42mSEND\e[0m] $string\n";
		fputs($socket, ircstrip($string)."\n");
		
	}
	function svskill($uid,$string)
	{
		$this->sendraw("SVSKILL $uid :$string");
=======
		global $socket;
		echo "[SEND] $string\n";
		fputs($socket, ircstrip($string)."\n");
		
	}
	function Send($string)
	{
		$this->sendraw($string);
	}
	function svskill($uid,$string)
	{
		global $cf;
		$sid = $cf['sid'];
		
		$this->sendraw(":$sid SVSKILL $uid :$string");
>>>>>>> 1d6af964a27a04cb46dafb3c58b0c93538e7352a
	}
	function shout($string)
	{
		global $me;
		echo "[".$me."][-->] ".$string."\n";
	}
	function hear($string)
	{
		global $me;
		echo "[".$me."][<--] ".$string."\n";
	}
}
hook::func("raw", function($u)
{
<<<<<<< HEAD
	global $fsync,$cf;
	$us = $cf['sid'];
	$parv = explode(" ",$u['string']);
	if ($parv[0] !== "NETINFO"){ return; }
	$fsync = true;
	hook::run("SID", array(
		"server" => $cf['servicesname'],
		"hops" => "0",
		"sid" => $cf['sid'],
		"desc" => $cf['network'],
		"intro_by" => $us)
	);
=======
	global $fsync;
	$parv = explode(" ",$u['string']);
	if ($parv[0] !== "NETINFO"){ return; }
	$fsync = true;
>>>>>>> 1d6af964a27a04cb46dafb3c58b0c93538e7352a
	hook::run("start", array());
	
});


/* SID */
hook::func("raw", function($u)
{
<<<<<<< HEAD
	global $cf;
=======
	
>>>>>>> 1d6af964a27a04cb46dafb3c58b0c93538e7352a
	$parv = explode(" ",$u['string']);
	if ($parv[1] !== "SID")
		return;
	$us = mb_substr($parv[0],1);
<<<<<<< HEAD
	if (!$us)
		$us = $cf['sid'];
	$servername = $parv[2];
	$hops = $parv[3];
	$sid = $parv[4];
	$description = mb_substr($u['string'],strlen($parv[0]." ".$parv[1]." ".$parv[2]." ".$parv[3]." ".$parv[4]." ") + 1);
=======
	$servername = $parv[2];
	$hops = $parv[3];
	$sid = $parv[4];
	$description = mb_substr(str_replace($parv[0]." ".$parv[1]." ".$parv[2]." ".$parv[3]." ".$parv[4]." ","",$u['string']),1);
>>>>>>> 1d6af964a27a04cb46dafb3c58b0c93538e7352a
	
	hook::run("SID", array(
		"server" => $servername,
		"hops" => $hops,
		"sid" => $sid,
		"desc" => $description,
		"intro_by" => $us)
	);
<<<<<<< HEAD
});
=======

});


hook::func("start", function($u)
{
	global $cf;
	hook::run("SID", array(
		"server" => $cf['servicesname'],
		"hops" => "0",
		"sid" => $cf['sid'],
		"desc" => $cf['network'])
	);
});
>>>>>>> 1d6af964a27a04cb46dafb3c58b0c93538e7352a
