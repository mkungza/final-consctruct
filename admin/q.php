<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
 
    $message = " To: =?windows-874?¤T0......´V0”R0QgpNiz4ai5?= ; ¤Ø³¡Øé§ PD ; à¨ÕêÂº PD ; àµé PD
 Cc: ¾Õè¡Ôè§ µÃÇ¨ÊÍº ; ¾Õè¨ÍÂ MKT
 Sent: Monday, April 06, 2015 7:57 AM


 àÃÕÂ¹ ½èÒÂ¼ÅÔµÀÑ³±ì

 Êè§â»ÃâÁªÑè¹ Clearance Sale Ê=0ü`0`0Òà«ç¹·ÃÑÅ¾ÅÒ«Ò»Ôè¹à¡ÅéÒÁÒãËé¹Ð¤Ð ÁÕá¡éä¢ÊèÇ¹Å´¢Í§¡ÃÍºáÇè¹Å´ÃÒ¤Ò¤èÐ (ÃÒÂÅÐàÍÕÂ´µÒÁä¿Åìá¹º) ã¹ÇÑ¹¹Õé (6-4-58) ¨ÐÊè§àÁÅÅìá¨é§ÊÒ¢ÒãËé·ÃÒº¤èÐ ½èÒÂ¼ÅÔµÀÑ³±ì=0üP0P0Ø³ÒÊè§¢éÍÁÙÅ¡ÃÍºáÇè¹Å´ÃÒ¤ÒãËé¡Ñº½èÒÂµÃÇ¨ÊÍºà¾×èÍ Set ã¹ÃÐºº¹Ð¤Ð

 &P0ü@0@0; ¢Íº¤Ø³¤èÐ/ÈÔÃÔÃÑµ¹ì MKT

 From: anunchai [mailto:anunchai@btv.co.th]
 Sent: Monday, April @0ü0 00 02015 7:35 AM
 To: sirirat
 Subject: Re: ¢ÍÍ¹ØÁÑµÔâ»ÃâÁªÑè¹ Clearance Sale ÊÒ¢Òà«ç¹·ÃÑÅ¾ÅÒ«Ò»Ôè¹à¡ÅéÒ

 Í¹ØÁÑµÔ¤ÃÑº

 From: sirirat
 Sent: Monday, April 06, 2015 7:27 AM
 To: ¾Õè¨ÍÂ MKT

 Subject: ¢ÍÍ¹ØÁÑµÔâ»ÃâÁªÑè¹ Clearance Sale ÊÒ¢Òà«ç¹·ÃÑÅ¾ÅÒ«Ò»Ôè¹à¡ÅéÒ

 àÃÕÂ¹ ¾Õè¨ÍÂ


 ¢ÍÍ¹ØÁÑµÔâ»ÃâÁªÑè¹ Clearance Sale ÊÒ¢Òà«ç¹·ÃÑÅ¾ÅÒ«Ò»Ôè¹à¡ÅéÒ ÃÐËÇèÒ§ÇÑ¹·Õè 7 àÁ.Â.-12 ¾.¤.58 ÃÒÂÅÐàÍÕÂ´µÒÁä¿Åìá¹º¤èÐ

 ¢Íº¤Ø³¤èÐ/ÈÔÃÔÃÑµ¹ì MKT";
     
    $tis620 = iconv("utf-8", "tis-620", $message );
    $utf8 = iconv("tis-620", "utf-8", $tis620 );
     
    echo "Page charset=utf-8";
    echo "<br/>";
    echo "Convert from UTF-8 to TIS-620 = ".$tis620;
    echo "<br/>";
    echo "Convert from TIS-620 to UTF-8 = ".$utf8;
 
?>
</body>
</html>