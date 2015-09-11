<?php
	// ������� ������������ ����������
	function upload_image()
	{
		if($_FILES["filename"]["size"]==0)
		{
			echo ("���� �����, ������ ����");
			exit;
		}
		
		// �������� ������ ����� (����� �������� ��������� � php.ini)
		if($_FILES["filename"]["size"]>1024*1*1024)
		{
			echo ("����� ����� �������� ���� ��������");
			exit;
		}
			
		// �������� ���������� ���� �����
		if($_FILES["filename"]["type"]!="image/jpg" && $_FILES["filename"]["type"]!="image/jpeg" && $_FILES["filename"]["type"]!="image/png")
		{
			echo ("�� ����, ������ ����� ".$_FILES["filename"]["type"]." �� �����������");
			exit;
		}
			
		// �������� ������������ �����
		if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
		{
			// ���� ���� ������������ ������ - ��������� � ������ ���������	
     		$image_name = "images/thumbs/".$_FILES["filename"]["name"];
     		$image_name_view = $_FILES["filename"]["name"];
     		$image_name_big = "images/big/".$_FILES["filename"]["name"];
     				
     		move_uploaded_file($_FILES["filename"]["tmp_name"], "images/thumbs/".$_FILES["filename"]["name"]);
     						
     		// ���������
     		$file = "images/thumbs/".$_FILES["filename"]["name"];
			$newfile = "images/big/".$_FILES["filename"]["name"];		
     		if (!copy($file, $newfile)) 
     		{
				echo '�� ������� ���������'.$file.'...\n';
			}
						
     		////////////////////////////////////////////////////////////////////////////////
     		$file_name = "images/thumbs/".$_FILES["filename"]["name"];
     		switch($_FILES['filename']['type']) 
			{ 
				// ������ ��� �������� 
				case "image/jpeg": $im = imagecreatefromjpeg($file_name); break; 
				case "image/png": $im = imagecreatefrompng($file_name); break; 
				case "image/jpg": $im = imagecreatefromjpeg($file_name); break;		
			} 
			
			list($w,$h) = getimagesize($file_name); // ����� ������ � ������ 
			if($w<$h && ($w/$h)<0.75)
			{
				$koe=$w/200; // ��������� ����������� 200 ��� ������ ������� ������ ����
				$new_h=ceil($h/$koe); // � ������� ������������ ��������� ������
				$im1 = imagecreatetruecolor(200, $new_h); // ������� ��������
				imagecopyresampled($im1,$im,0,0,0,0,200,$new_h,imagesx($im),imagesy($im)); 
			}
			else if ($w>$h && ($h/$w)<0.75)
			{
				$koe=$w/700; // ��������� ����������� 200 ��� ������ ������� ������ ����
				$new_h=ceil($h/$koe); // � ������� ������������ ��������� ������
				$im1 = imagecreatetruecolor(700, $new_h); // ������� ��������
				imagecopyresampled($im1,$im,0,0,0,0,700,$new_h,imagesx($im),imagesy($im)); 			
			}
			else
			{
				$koe=$w/300; // ��������� ����������� 200 ��� ������ ������� ������ ����
				$new_h=ceil($h/$koe); // � ������� ������������ ��������� ������
				$im1 = imagecreatetruecolor(300, $new_h); // ������� ��������
				imagecopyresampled($im1,$im,0,0,0,0,300,$new_h,imagesx($im),imagesy($im)); 
			}
			imageconvolution($im1, array( // �������� ��������
			array(-1,-1,-1), 
			array(-1,16,-1), 
			array(-1,-1,-1)), 8, 0); 
			imagejpeg($im1, $file_name, 100); // ��������� � jpg
			imagedestroy($im); 
			imagedestroy($im1);
			/////////////////////////////////////////////////////////////////////////////
					
			echo "���������� ������ ������";
			
			?>
			<div class="container-fluid">
				<a href="upload.html">������ ��...<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
			</div>
	
			<div class="container-fluid">
				<a href="index.php">�� ������<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
			</div>
			<?
						
			// ���� ����������
			include "image_class.php";
			// ����� ��������� �����
			$object = new Image;
			// �������� ���
			$today = date("y-m-d");
			// ��������� ��������� ��'����
			$object->SetAttribute($_FILES["filename"]["name"], $today, $_FILES["filename"]["size"], $_POST['comment']);
			// ������ � ����
			$object->AddDatabase();
		}
		else 
		{
			echo("������� ������������ �����");
		}
	}

	// ������������ ����������
	upload_image();
?>