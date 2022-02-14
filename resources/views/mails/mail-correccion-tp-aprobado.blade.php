<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style='font-family:Arial'>

<div style='font-family:Arial;text-align:center;width: 60%;margin-left: auto; margin-right: auto;background: #FE642E; border-radius: 18px;display:block; float:center;'>
	<h2 style='padding: 15px;color:#FFF; font-weight: bold; text-align: center'>INSTITUTO WORK NOW</h2> 
</div>
<p style='text-align: center; color: #4b5665; line-height: 21px; font-size: 18px;'><span style='font-size: 24px;'>Hola <strong>{{$user->name ?? "Nombre Completo"}}</strong>! C&oacute;mo estás?</span> <br>
¡Felicidades! tu trabajo pr&aacute;ctico est&aacute; <strong style="color:#088A08;">aprobado </strong></p>
<h2 style='text-align: center; color: #664437; line-height: 21px; '>Unidad: {{$tp->unity->nombre ?? '--'}} </h2>
<h4 style='text-align: center; color: #a3613b; line-height: 21px; font-size: 18px;'>Tp N°: {{$tp->numero ?? '--'}} </h4>
<h3 style='text-align: center; color: #c98456; line-height: 21px; font-size: 18px;'><strong>Nota: </strong>{{$nota ?? "Error"}} </h3>
<div style=''><img style='display:block;margin-left: auto; margin-right: auto;width: 300px;' src='https://worknow-cursos.com/img/festejo.jpg' /></div>

@if ($msj ?? '' != '')

<div style='color: #4b5665;margin-top:15px;'>
	<div style="width: 40%;text-align: start;margin:auto;border: 2px solid #FAAC58;border-radius:15px;padding-left: 25px;padding-right:25px">
		<h3>Nota del profesor:</h3>
		<hr>
		<p>{{$msj ?? "Error"}} </p>
	</div>
</div>

@endif

<div style='text-align: center;' >
	<p style='color: #FAAC58; line-height: 21px; font-size: 18px;margin-bottom:30px;'>Cuando lo desees podes continuar con el desarrollo del curso.</p>
	<a style="padding: 15px; background: rgb(192, 138, 68); border-radius:15px; color:#FFF;" href="/Unidad/{{$tp->unity->id ?? null}}">Ir a la unidad</a>
	<p style="color: #A4A4A4;margin-top:30px;">Recorda consultar a tu profesor por whatsapp de Lun. a Vie. de 10 a 20 hs.</p>
	<p style="color: #A4A4A4;">O por este mismo correo</p>
</div>
<div >
<table style='display: flex;justify-content: center;align-items: center;' class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-del-min-width m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-tmpl-width' width='100%' cellpadding='0' border='0' cellspacing='0' bgcolor='#f9fafc' name='Layout_' id='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-Layout_' style='min-width:590px;width:590px'><tbody><tr><td class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-del-min-width' align='center' valign='top' bgcolor='#f9fafc' style='border-collapse:collapse;min-width:590px'><table width='590' class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-container' cellpadding='0' border='0' align='center' cellspacing='0'><tbody><tr><td height='20' style='border-collapse:collapse;font-size:1px;line-height:1px'>&nbsp;</td></tr><tr><td valign='top' class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-container-padding' align='left' style='border-collapse:collapse;font-size:14px;font-family:Arial,Helvetica,sans-serif;color:rgb(136,136,136)'><table width='100%' border='0' cellpadding='0' cellspacing='0' class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-columns-container'><tbody><tr><td class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-force-col' valign='top' style='border-collapse:collapse;padding-right:20px;padding-left:20px'><table border='0' valign='top' cellspacing='0' cellpadding='0' width='264' align='left' class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-col-2' style='border-bottom:0px'><tbody><tr><td valign='top' style='border-collapse:collapse'><table cellpadding='0' border='0' align='left' cellspacing='0' class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-btn-col-content'><tbody><tr><td valign='middle' align='left' class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-text-center' style='border-collapse:collapse;font-family:Arial,Helvetica,sans-serif'><div><div>Work Now Cursos<br>11 2694 2226<br>MDQ, CP7600<br>CABA, CP1428<br><a href='https://my.sendinblue.com/camp/showpreview/id/27#' style='color:rgb(102,102,102)' target='_blank' data-saferedirecturl='https://www.google.com/url?q=https://my.sendinblue.com/camp/showpreview/id/27%23&amp;source=gmail&amp;ust=1548339436236000&amp;usg=AFQjCNE2hiKhyGADz7Y2axjhkSAJmCyG-g'>alumnos@worknowcursos.com</a></div></div></td></tr></tbody></table></td></tr></tbody></table></td><td class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-force-col m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-social-width' valign='top' style='border-collapse:collapse;padding-right:15px'><table border='0' valign='top' cellspacing='0' cellpadding='0' width='246' align='right' class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-last-col-2'><tbody><tr><td valign='top' style='border-collapse:collapse'><table cellpadding='0' border='0' cellspacing='0' class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-social-align' align='right' style='float:right'><tbody><tr><td valign='middle' class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-text-center' width='85' align='right' style='border-collapse:collapse'><div class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-social-center'><table align='left' border='0' cellpadding='0' cellspacing='0' style='float:left;display:inline-block'><tbody><tr><td align='left' style='border-collapse:collapse;padding:0px 5px 5px 0px'><span style='color:rgb(255,255,255)'><a href='https://www.facebook.com/WorkNowarg/' target='_blank' data-saferedirecturl='https://www.google.com/url?q=https://www.facebook.com/WorkNowarg/&amp;source=gmail&amp;ust=1548339436236000&amp;usg=AFQjCNFFJjZzil1R7uXNXjZ-kRaC0MziWw'><img alt='Facebook' border='0' hspace='0' vspace='0' src='https://ci5.googleusercontent.com/proxy/lSkv6A04VUKQTkRddYrPg7o-Bxzozl9Bnl7XN-mOrPTzj4Ob7cz30iOTkj1vi9pDIWO79R2VHrfWCTtJHIVLVweWPw1H5v1qF4PkbXI44wvL=s0-d-e1-ft#http://img.mailinblue.com/new_images/rnb/theme5/rnb_ico_fb.png' style='vertical-align:top' class='CToWUd'></a></span></td></tr></tbody></table></div><div class='m_-3791644720194112676m_-5077930976808664309gmail-m_-7832111776023786876m_-1983291102630745082gmail-rnb-social-center'><table align='left' border='0' cellpadding='0' cellspacing='0' style='float:left;display:inline-block'><tbody><tr><td align='left' style='border-collapse:collapse;padding:0px 5px 5px 0px'><span style='color:rgb(255,255,255)'><a href='https://www.instagram.com/worknowarg/' target='_blank' data-saferedirecturl='https://www.google.com/url?q=https://www.instagram.com/worknowarg/&amp;source=gmail&amp;ust=1548339436236000&amp;usg=AFQjCNGfqWATRlLhzVpEf4J_BEAzLPjAQw'><img alt='Instagram' border='0' hspace='0' vspace='0' src='https://ci4.googleusercontent.com/proxy/cUFg0Ysnzaor5bg_lrB83LzjqQ_6OvYzqQOIyy27-K-CpmcJljVWiMxNEFx-TLweor4hVeMQgjibDkDMuY7TdG6HsSHdGypnKXcc0OxbYdFE=s0-d-e1-ft#http://img.mailinblue.com/new_images/rnb/theme5/rnb_ico_ig.png' style='vertical-align:top' class='CToWUd'></a></span></td></tr></tbody></table></div></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td height='20' style='border-collapse:collapse;font-size:1px;line-height:1px'>&nbsp;</td></tr></tbody></table></td></tr></tbody></table></div>

</body>
</html>

