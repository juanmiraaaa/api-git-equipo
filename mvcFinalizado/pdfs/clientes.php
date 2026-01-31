<?php
require_once('pdf_mc_table.php');
 
class ClientesPDF extends PDF_MC_Table
{
    public $filas;
 
    // Cabecera de página
    function Header()
    {
        // Ponemos el título de la página
        $this->SetFont('Arial','B',16);
        $this->Cell(0, 10,'LISTADO DE CLIENTES', 1, 0, 'C');
 
        // Ponemos el título de las celdas
        $this->SetXY(10, 20);
        $this->SetFillColor(0,0,0);
        $this->SetTextColor(255,255,255);
        $this->Cell(75, 10, 'Nombre', 1, 0, 'C', true);
        $this->Cell(75, 10, 'Email', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Apellidos', 1, 0, 'C', true);
        $this->Ln();
    }
 
    // Pie de página
    function Footer()
    {
        // Posición: a 1 cm del final de la página
        $this->SetY(-10);
 
        // Arial 10
        $this->SetFont('Arial','',10);
 
        // Fecha y hora
        $fechayhora = date('d/m/Y - H:i');
        $this->Cell(50, 10, $fechayhora, 0, 0, 'L');
 
        // Número de página
        $this->Cell(227,10,
                    mb_convert_encoding('Página '.$this->PageNo().'/{nb}', 'ISO-8859-1', 'UTF-8'),
                    0,0,'R');
    }
 
    public function Imprimir()
    {
        if ($this->filas)
        {
            foreach ($this->filas as $fila)
            {
                $this->Row(array($fila->nombre,
                                 $fila->email,
                                 $fila->apellidos,
                                ));
            }
        }        
    }
}
?>