<?php
class FPDF
{
function __construct(){}
function AddPage(){}
function SetFont($family,$style='',$size=0){}
function Cell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=false,$link=''){
    echo $txt . "<br>";
}
function Ln($h=null){}
function Output(){
    exit;
}
}
?>