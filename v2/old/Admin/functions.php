<?php
function create_thumbnail($file) {
    $maxsize = 100; // Maximale breedte of hoogte van een thumbnail
    $dir = '../Images/uploads/'; // Map waarin de thumbnail weggeschreven moet worden
    $prefix = 'tn_'; // Prefix die alle thumbnails meekrijgen.
    $extensie = array('jpeg', 'jpg', 'png', 'gif', 'JPG'); // Toegestane extensies.
    
    $pathinfo = pathinfo($file);
    $destination = $dir.$prefix.$pathinfo['basename'];
        echo "create_thmug";
    // Controleren of de thumbnail al bestaat.
    if(file_exists($destination))
    {
        echo '<p>bestaat al</p>';
        return true;
    }
    else
    {
    echo "ja";
        // Controleren of de extensie wel gebruikt kan worden.
        if(!in_array($pathinfo['extension'], $extensie))
        {
            echo '<p>Dit bestand heeft niet de juiste extensie</p>';
            return false;
        }
        else
        {
            // echo 'image: ', getimagesize($file);
            // Afmetingen van het origineel ophalen.
            list($width_orig, $height_orig) = getimagesize($file);
            // Bepalen van de nieuwe afmetingen:
            // -> breedte en hoogte < maxsize: niet resizen, originele afmetingen behouden.
            // -> breedte < hoogte: de hoogte is de maxsize, de breedte naar verhouding aanpassen.
            // -> breedte > hoogte: de breedte is de maxsize, de hoogte naar verhouding aanpassen.
            if($width_orig < $maxsize && $height_orig < $maxsize)
            {
                $height = $height_orig;
                $width = $width_orig;
            }
            elseif($width_orig < $height_orig) 
            {
                $height = round(($maxsize / $width_orig) * $height_orig);
                $width = $maxsize;
            } 
            else 
            {
                $height = $maxsize;
                $width = round(($maxsize / $height_orig) * $width_orig);
            }
            
            // Resizen en cre?ren van de nieuwe afbeelding (verschillend voor PNG, GIF en JPG/JPEG):
            // -> Origineel aanmaken
            // -> Nieuwe afbeelding met nieuwe afmetingen cre?ren
            // -> Origineel naar verhouding in nieuwe afbeelding resizen.
            // -> Nieuwe afbeelding naar bestand schrijven.
            switch(strtolower($pathinfo['extension']))
            {
                case 'png' : 
                    $source = imagecreatefrompng($file); 
                    break;
                case 'jpg' : 
                    $source = imagecreatefromjpeg($file); 
                    break;
                case 'JPG' : 
                    $source = imagecreatefromjpeg($file); 
                    break;
                case 'jpeg' : 
                    $source = imagecreatefromjpeg($file); 
                    break;
                case 'gif' : 
                    $source = imagecreatefromgif($file); 
                    break;
                default: 
                    return false;
            }
            
            $thumb = imagecreatetruecolor($width, $height);

            imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
            
            echo $source;
            echo "succes";

            switch(strtolower($pathinfo['extension']))
            {
                case 'png' : 
                    return imagepng($thumb, $destination);
                    break;
                case 'jpg' : 
                    return imagejpeg($thumb, $destination);
                    break;
                case 'JPG' : 
                    return imagejpeg($thumb, $destination);
                    break;
                case 'jpeg' : 
                    return imagejpeg($thumb, $destination);
                    break;
                case 'gif' : 
                    return imagegif($thumb, $destination);
                    break;
            }
        }
    }
    return false;
}

function dateFormat($sDateFormat, $sDateField, $sTaal = 'nl'){ 
  
    // format een datetime veld uit mysql met de argumenten van de functie date() 

    $aDate = array(); 

    $aDate['d'] = 'DATE_FORMAT(' . $sDateField . ", '%d')"; 
    $aDate['g'] = 'DATE_FORMAT(' . $sDateField . ", '%l')"; 
    $aDate['G'] = 'DATE_FORMAT(' . $sDateField . ", '%k')"; 
    $aDate['h'] = 'DATE_FORMAT(' . $sDateField . ", '%h')"; 
    $aDate['H'] = 'DATE_FORMAT(' . $sDateField . ", '%H')"; 
    $aDate['i'] = 'DATE_FORMAT(' . $sDateField . ", '%i')"; 
    $aDate['j'] = 'DATE_FORMAT(' . $sDateField . ", '%e')"; 
    $aDate['m'] = 'DATE_FORMAT(' . $sDateField . ", '%m')"; 
    $aDate['n'] = 'DATE_FORMAT(' . $sDateField . ", '%c')"; 
    $aDate['s'] = 'DATE_FORMAT(' . $sDateField . ", '%S')"; 
    $aDate['Y'] = 'DATE_FORMAT(' . $sDateField . ", '%Y')"; 
    $aDate['y'] = 'DATE_FORMAT(' . $sDateField . ", '%y')"; 
    $aDate['z'] = 'DATE_FORMAT(' . $sDateField . ", '%j')"; 
    $aDate['w'] = 'DATE_FORMAT(' . $sDateField . ", '%w')"; 

    $aDate['%'] = '%%';  

    switch ($sTaal){ 
      case 'nl': 

        $aDate['D'] = 'ELT((WEEKDAY('. $sDateField .")+1),  
        'ma','di','wo','do','vr','za','zo')"; 

        $aDate['F'] = 'ELT(MONTH(' .    $sDateField . "),     
        'Januari','Februari','Maart','April','Mei','Juni', 
        'Juli','Augustus','September','Oktober','November', 
        'December')"; 

        $aDate['l'] = 'ELT((WEEKDAY(' . $sDateField . ")+1),  
        'Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag', 
        'Zaterdag','Zondag')"; 

        $aDate['m'] = 'ELT(MONTH(' .    $sDateField . "),     
        'jan','feb','mrt','apr','mei','jun','jul', 
        'aug','sep','okt','nov','dec')"; 

        break;        

      case 'en': 

        $aDate['D'] = 'DATE_FORMAT(' . $sDateField . ", '%a')"; 
        $aDate['F'] = 'DATE_FORMAT(' . $sDateField . ", '%M')"; 
        $aDate['l'] = 'DATE_FORMAT(' . $sDateField . ", '%W')"; 
        $aDate['m'] = 'DATE_FORMAT(' . $sDateField . ", '%b')"; 
        break; 
    } 

    $aReturn = array(); 

    $iFormatLength = strlen($sDateFormat); 

    for($i = 0; $i <$iFormatLength; $i++) { 

      // replace argumenten per karakter 

      $sChar = substr($sDateFormat, $i, 1); 

      if (array_key_exists($sChar, $aDate)){ 

        $aReturn[] = $aDate[$sChar]; 

      } else { 

        $aReturn[] = "'" . $sChar . "'"; 

      } 

    } 
    return 'CONCAT(' . implode(',', $aReturn) . ')'; 
} 
  
function paging($pagenum, $page_url, $sql, $page_rows) {
  if($pagenum == "") {
    $pagenum = 1;
  } else {
    if($pagenum < 10) {
      $length_get = 10;
    } else {
      $length_get = 11;
    }
    $page_url = substr($page_url, 0, -$length_get);
  }

  $result = mysql_query($sql) or die(mysql_error());
  $rows = mysql_num_rows($result);

  $last = ceil($rows/$page_rows);

  if($last < 1) {
    $last = 1;
  }
  if($pagenum < 1) {
    $pagenum = 1;
  } elseif($pagenum > $last) {
    $pagenum = $last;
  }
  
  $max = 'LIMIT ' .($pagenum-1) * $page_rows .', ' .$page_rows;

  if((($pagenum-1) * $page_rows) < 0) {
    $new_sql = $sql;
  } else {
    $new_sql = $sql." ".$max;
  }
  return array($pagenum, $page_url, $new_sql, $last, $page_rows, $rows);
}

// Checks if the value is already in the array
function list_check($serie, $array) {
	foreach($array as $n) {
    $n = trim($n);
    $serie = trim($serie);
		if($n == $serie) {
			return true;
		}
	}
	return false;	
}
?>