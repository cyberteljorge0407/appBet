<?php 

class viewModel{

	protected function get_view_model($views){


		$listView=["home","charge", "clientes","historycharge"];
		if(in_array($views,$listView)){
			if(is_file("./view/content/".$views."-view.php")){
				$content ="./view/content/".$views."-view.php";
			}else{
				$content="login";
			}	
		}elseif($views=="login"){
			$content="login";
		}elseif($views == "index"){
			$content="login";
		}else{
			$content = "404";
		}
		return $content;
	}
}