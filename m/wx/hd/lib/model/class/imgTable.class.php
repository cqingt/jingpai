<?php
require_once('jpgraph/jpgraph.php');
class imgTable{
	private $width;
	private $height;

	public function __construct($w,$h){
		$this->width = $w;
		$this->height = $h;
	}

	public function histogram($dataX,$dataY,$title){//������״ͼ
		require_once('jpgraph/jpgraph_bar.php');

		$graph = new Graph($this->width,$this->height);
		$graph->SetScale('textlin');  
		$graph->SetShadow();  
		$graph->img->SetMargin(50,10,40,50);
		$graph->legend->SetFont(FF_SIMSUN,FS_BOLD);
		$graph->SetColor('wheat');  
		  
		//����  
		$barplot = new BarPlot($dataY);
		//$barplot->SetColor('blue');    
		$barplot->SetFillColor('lightblue');
		$barplot->value->Show();
		$barplot->value->SetFormat('%d');
		$barplot->SetLegend("���۽��");//����ע�� 
		$barplot->SetWidth(0.6);//������״���
		  
		$graph->Add($barplot);
		$graph->title->Set($title);
		$graph->title->SetFont(FF_SIMSUN,FS_BOLD,12);    
		$graph->title->SetMargin(10);
		$graph->xaxis->title->SetFont(FF_SIMSUN,FS_BOLD,16);  
		$graph->xaxis->title->Set('����');    
		$graph->xaxis->SetTickLabels($dataX);
		$graph->xaxis->SetFont(FF_SIMSUN,FS_BOLD); 
		
		$graph->yaxis->title->SetFont(FF_SIMSUN,FS_BOLD,16);   
		$graph->yaxis->title->Set('��Ԫ');
		$graph->yaxis->title->SetMargin(5); 
		  
		$graph->Stroke();  
	}
}
?>