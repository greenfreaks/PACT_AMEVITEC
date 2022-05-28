<?php
require 'fpdf.php';

	class PDF extends FPDF
	{
		function Header()
		{
			#$this->Image('images/logo.png', 5 , 5 , 30); //direccion, coordenadax, coordenaday, tamaño
			$this->Image('views/technology/images/nuevoMembrete.jpg',0,0,210,300,'JPG');																
			//IMAGE (RUTA,X,Y,ANCHO,ALTO,EXTEN)
			$this->SetFont('Arial','B',15);
			#$this->Cell(0);
			$this-> SetY(35);
			#$this->Cell(0,10, 'Reporte Nivel de Madurez de la Tecnologia',0,0,'C');
			$this->Ln(10);//salto de linea
			
		}
		
		function Footer()
		{
			$this->SetY(-18);
			$this->SetFont('Arial','I',8);// italica
			$this->SetTextColor(255, 255, 255);
			$this->Cell(360,10, utf8_decode('Pág. '.$this->PageNo().'/{nb}'),0,0,'C');  // tamaño 0 puede estar en el centro y ocupar toda la pantalla, se concatena con un punto
			//nb es una variable concatenada
			//utf8_decode permite mostrar acentos en el reporte
		}
	}
?>