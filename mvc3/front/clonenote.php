<?php
//    ob_start(); 
//    include 'includes/db.php';  

//    session_start();
//    if(!isset($_SESSION['ID'])){
//        header("location:login.php");
//    }
    

//    if(isset($_GET['noteid'])){
//        
//        $noteid = $_GET['noteid'];
//        $loginID = $_SESSION['ID'];
//        
//        $fetch_data1 = mysqli_query($connection,"SELECT * FROM seller_notes WHERE ID = $noteid");
//        $data1 = mysqli_fetch_assoc($fetch_data1);
//        $title = $data1['Title'];
//        $category = $data1['Category'];
//        $displaypicnewname = $data1['DisplayPicture'];
//        $type = $data1['NoteType'];
//        $pages = $data1['NumberofPages'];
//        $description = $data1['Description'];
//        $institution = $data1['UniversityName'];
//        $country = $data1['Country'];
//        $course = $data1['Course'];
//        $coursecode = $data1['CourseCode'];
//        $professor = $data1['Professor'];
//        $sellfor = $data1['IsPaid'];
//        $price = $data1['SellingPrice'];
//        $previewnewname = $data1['NotesPreview'];
//        
//        
//        $fetch_data2 = mysqli_query($connection,"SELECT * FROM seller_notes_attachements WHERE NoteID = $noteid");
//        
//        //for seller_note table
//        insert_data1_query = "INSERT INTO seller_notes(SellerID, Status , Title , Category , DisplayPicture , NoteType , NumberofPages , Description , UniversityName , Country , Course , CourseCode , Professor , IsPaid , SellingPrice , NotesPreview , CreatedBy) VALUES ($loginID , 6 , '$title' , '$category' , '$displaypicnewname' , '$type' , '$pages' , '$description' , '$institution' , '$country' , '$course' , '$coursecode' , '$professor' , $sellfor , '$price' , '$previewnewname' , $loginID)";
//        
//        //for seller_notes_attachment table
//        while($row = mysqli_fetch_assoc($fetch_data1)){
//            
//            $insertquery1 ="INSERT INTO seller_notes_attachements( NoteID , FileName , FilePath , CreatedBy, ModifiedBy, IsActive) VALUES ('$noteid' , '$uploadnotenewname' , '$uploadnote_dest' , '$loginID' , '$loginID' , 1 )";
//            
//        }
//        
//    }else{
//        
//        header("location:myrejectednotes.php");
//        
//    }

?>