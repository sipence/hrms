<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
//header("Access-Control-Allow-Origin: *");
class Year extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function header()
    {
        try {

            $this->load->view('include/header');
        } catch (Exception $e) {
            echo "Message:" . $e->getMessage();
        }

    }

    public function footer()
    {
        try {
            $this->load->view('include/footer');
        } catch (Exception $e) {
            echo "Message:" . $e->getMessage();
        }
    }

    public function sidebar()
    {
        try {
            $this->load->view('dashboard/sidebar');
        } catch (Exception $e) {
            echo "Message:" . $e->getMessage();
        }
    }

    public function navbar()
    {
        try {
            $this->load->view('include/navbar');
        } catch (Exception $e) {
            echo "Message:" . $e->getMessage();
        }
    }
    public function index(){
        try {
            $this->header();
            $this->navbar();
            $this->load->view('forms/formYear');
            $this->footer();
        } catch (Exception $e) {
            echo "Message:" . $e->getMessage();
        }
    }
    public function action(){
        try{
            $request = json_decode(json_encode($_POST), FALSE);
            $data=array();
            $insert=array();
            $status=true;
            if(isset($request->year)&& is_numeric($request->year)){
                $insert[0]['year']=$request->year;
            }else{
                $data['status']=false;
            }
            if(isset($request->isactive) && preg_match("/[0,1]{1}/",$request->isactive)){
                if($request->isactive==1){
                    $insert[0]['isactive']=true;
                }else if($request->isactive==0){
                    $insert[0]['isactive']=false;
                }else{
                    $status=false;
                }
            }else{
                $status=false;
            }
            if($status){
                if(isset($request->txtid) && is_numeric($request->txtid)){
                    if($request->txtid>0){
                        $insert[0]['updatedby']=1;
                        $insert[0]['updatedat']=date("Y-m-d H:i:s");
                        $res=$this->Model_Db->update(37,$insert,"id",$request->txtid);
                        if($res!=false){
                            $data['message']="Update successful.";
                            $data['status']=true;
                        }else{
                            $data['message']="Update failed.";
                            $data['status']=false;
                        }
                    }else if($request->txtid==0){
                        $insert[0]['entryby']=2;
                        $insert[0]['createdat']=date("Y-m-d H:i:s");
                        $res=$this->Model_Db->insert(37,$insert);
                        if($res!=false){
                            $data['message']="Insert successful.";
                            $data['status']=true;
                        }else{
                            $data['message']="Insert failed.";
                            $data['status']=false;
                        }
                    }else{
                        $data['message']="Insufficient/Invalid data.";
                        $data['status']=false;
                    }
                }else{
                    $data['message']="Insufficient/Invalid data.";
                    $data['status']=false;
                }
            }else{
                $data['message']="Insufficient/Invalid data.";
                $data['status']=false;
            }
            echo json_encode($data);
            exit();
        }catch (Exception $e){
            $data['message']= "Message:".$e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
            exit();
        }
    }
    public function report_year(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST), FALSE);
//            $postdata = file_get_contents("php://input");
//			$request = json_decode($postdata);
            if(isset($request->onlyactive) && is_numeric($request->onlyactive)){
                $where="isactive=true";
            }else{
                $where="1=1";
            }
            $res=$this->Model_Db->select(37,null,$where);
            if($res!=false){
                foreach ($res as $r){
                    $data[]=array(
                        'id'=>$r->id,
                        'year'=>$r->year,
                        'creationdate'=>$r->createdat,
                        'lastmodifiedon'=>$r->updatedat,
                        'isactive'=>$r->isactive
                    );
                }
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= "Message:".$e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
            exit();
        }
    }
}