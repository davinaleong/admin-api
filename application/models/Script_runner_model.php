<?php
// @codeCoverageIgnoreStart
defined("BASEPATH") OR exit("No direct script access allowed");

class Script_runner_model extends CI_Model
{
    public function handle_request($input_variables, $script)
    {
        $this->load->library('parser');

        $parsed_script=$this->parser->parse_string($script,$input_variables,TRUE);

        return $this->run_script($parsed_script);
    }

    public function run_script($parsed_script){
        $query_strs=explode(';',$parsed_script);
        $this->db->trans_start();
        $output_str='';
        array_pop($query_strs);
        foreach($query_strs as $query_str){
            try{
                $query=$this->db->query($query_str);
                if(is_object($query)){
                    $output_str=$output_str."<p><strong>$query_str</strong></p><p><pre>".json_encode($query->result_array(),JSON_PRETTY_PRINT)."</pre></p>";
                }else{
                    $success_msg=$query?"success":"failure";
                    $output_str=$output_str."<p><strong>$query_str</strong></p><p>".$success_msg."</p>";
                }
            }catch(Exception $e){
                $output_str=$output_str."<p><strong>$query_str</strong></p><p><pre>".$e->getMessage()."</pre></p>";
            }

        }
        $this->db->trans_complete();

        $output=array(
            'output_str'=>$output_str,
            'success'=>$this->db->trans_status()?"Success":"Failure"
        );

        return $output;
    }
}
//end Script_runner_model class
// @codeCoverageIgnoreEnd