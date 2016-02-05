<?php
class Split {
       protected $values = array();
//    public $values = array();

        public function GetUpInfo($int){
            $field=$this->values['field'];
            $table=$this->values['table'];
            $upfield=$this->values['upfield'];
            $fieldValue=$this->values['id'];
            $sql0="SELECT * FROM ".$table." WHERE ".$field." = '".$fieldValue. "'";
            $upinfo=array();
            $upinfo[0]=$this->QuerySql($sql0);
            if($int==0){
                return $upinfo[0];
            }
            else{
                for($i=1; $i<=$int; $i++){
                    $sqli="SELECT * FROM ".$table." WHERE ".$field." = '".$upinfo[($i-1)][$upfield]. "'";
                    $upinfo[$i]=$this->QuerySql($sqli);
                    $upinfo[$i] = empty($upinfo[$i]) ? 0 : $upinfo[$i];

                }
                  return  $upinfo[$int];

            }

        }

        public function QuerySql($sql){
            $row=$GLOBALS['db']->getRow($sql);
            return $row;
        }

        public function SetTable($table){
            $this->values['table']=$table;
        }

        public function SetField($str){
            $this->values['field']=$str;
        }

        public function SetUpField($str){
            $this->values['upfield']=$str;
        }


        public function SetID($str)
        {
            $this->values['id']=$str;
        }


    }
	
	
	
	

$user=new Split();
    $user->SetID('0');
    $user->SetTable('users');
    $user->SetField('openid');
    $user->SetUpField('p_openid');
    $inf00=$user->GetUpInfo(4);
 //   $inf11=$user->GetUpInfo(1);
 print_r($inf00['openid'].'------'.$inf00['nick_name']);
 //   print_r($inf11);


?>