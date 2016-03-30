<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	
	<title>Fractale</title>

	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
	<!--<link rel="stylesheet" href="css/animate.css">-->
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/progress-bar.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="top">
			<h1 id="title" class="hidden"><span id="logo">Fractale <span>ETNA</span></span></h1>
		</div>
		<table>
		    <tr>
		        <td>
            		<div class="login-box animated fadeInUp" style='margin-bottom:100px;width:350px;'>
            			<div class="box-header">
            				<h2>FRACTALISER</h2>
            			</div>
            			<form method="get">
            				
            		        <label for="iteration">Nombres d'itération</label>
            		        </br>
            		        <input type="text" name="iteration" id="iteration"/>
            		        </br>
            		        <label for='degre'>Degré</label>
            		        </br>
            		        <input type="text" name="degre" id='degre'/>
            		        </br>
            		        <label for="res">Résolution souhaité</label>
            		        <br/>
            		        <select name="res" id="res">
            		            <option value="150">750 x 750 pixels</option>
            		            <option value="250">1250 x 1250 pixels</option>
            		            <option value="350">1750 x 1750 pixels</option>
            		            <option value="450">2250 x 2250 pixels</option>
            		            <option value="550">2750 x 2750 pixels</option>
            		        </select>
            		        <br/></br>
            		        <input id="btnfract" type="submit" value="Fractaliser"/>
            		    </form>
            		</div>
		        </td>
		        <td>
            		<div id="fractcss">
            		<!-- Genere les fractales -->
                    <?php
                        $degre = $_GET[degre];
                        $iteration = $_GET[iteration];
                        $res = $_GET[res];
                        if ($iteration == null)
                            $iteration = 50;
                        if ($degre == null)
                            $degre = 2;
                        if ($res == null)
                            $res = 150;
                        $name = "mandelbrot/mandelbrot_i" . $iteration . "_d" . $degre . "_res" . $res . ".png";
                        if (!file_exists($name))
                        {
                            $x = 0;
                            $y = 0;
                            $x1 = -2.5;
                            $x2 = 2.5;
                            $y1 = -2.5;
                            $y2 = 2.5;
                            $taille = $res;
                
                            $x_image = ($x2 - $x1) * $taille;
                            $y_image = ($y2 - $y1) * $taille;
                
                            $img = imagecreatetruecolor($x_image, $y_image);
                            $black = imagecolorallocate($img, 0, 0, 0);
                            
                            $color[0] = imagecolorallocate($img, 95, 158, 160);
                            $color[1] = imagecolorallocate($img, 72, 209, 204);
                            $color[2] = imagecolorallocate($img, 0, 191, 255);
                            $color[3] = imagecolorallocate($img, 102, 205, 170);
                            $color[4] = imagecolorallocate($img, 72, 209, 204);
                            $color[5] = imagecolorallocate($img, 0, 255, 255);
                            $color[6] = imagecolorallocate($img, 0, 0, 255);
                            $color[7] = imagecolorallocate($img, 127, 0, 255);
                            
                            imagefilledrectangle($img, 0, 0, $x_image, $y_image, $white);
                
                            while ($x <= $x_image)
                            {
                                while ($y <= $y_image)
                                {
                                    $c_reel = $x / $taille + $x1;
                                    $c_imag = $y / $taille + $y1;
                                    $z_reel = 0;
                                    $z_imag = 0;
                                    $i = 0;
                                    $cnd = 0;
                                    while ( $cnd < 4 && $i < $iteration)
                                    {
                                        $tmp = pow(($z_reel * $z_reel + $z_imag * $z_imag), (($degre / 2))) * cos($degre * atan2($z_imag, $z_reel)) + $c_reel;
                                        $z_imag = pow(($z_reel * $z_reel + $z_imag * $z_imag), (($degre / 2))) * sin($degre * atan2($z_imag, $z_reel)) + $c_imag;
                                        $z_reel = $tmp;
                                        $i++;
                                        $cnd = $z_reel * $z_reel + $z_imag * $z_imag;
                                    }
                
                                    if ($i == $iteration)
                                        imagesetpixel($img, $x, $y, $black);   // Ajout du pixel sur l'image
                                    else
                                        imagesetpixel($img, $x, $y, $color[$i % 8]);
                                    $y++;
                                }
                                $y = 0;
                                $x++;
                            }
                            imagepng($img, $name); // Creation de l'image
                        }
                        echo "<img src='$name' width='500' height='500'></img>";
                    ?>
                    <!--Fin generation fractales-->
                    </div>
                </td>
            </tr>
		</table>
	</div>
	<script src='js/pace.min.js'></script>
</body>
</html>