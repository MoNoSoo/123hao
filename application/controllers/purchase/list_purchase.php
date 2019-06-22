<?php

/**
 *
 * 采购审批列表，示例单据
 * @author liutao
 * 2017-06-03
 */
class list_purchase extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     *
     * 列表
     */
    function loadView()
    {
        $this->load->view('top/bootstrap_top');
        $data = array();
        $this->load->view('purchase/list_purchase', $data);
        $foot_data = array();
        $this->load->view('top/foot', $foot_data);
    }

    /**
     *
     * 查询条件
     */
    public function query()
    {
        $ssn = isset($_SESSION["ssn"]) ? $_SESSION["ssn"] : "";
        $where = $this->getWhereSql();

        $sql = "
			select 
				id as dt_primary_id,id,et_uid,userno,username,createtime,contract_name,contract_type,goods_type,contract_sum
			from 
				t_purchase_contract
			where userno = '$ssn' 
		" . $where;

        $result = $this->simple_model->get_dt_pageresult($sql);
        //把数组以json格式输出
        echo json_encode($result);

    }

    /**
     *
     * 拼接语句
     */
    function getWhereSql()
    {
        $where = '';
        $request_array = array(
            'username', 'contract_name', 'contract_type', 'goods_type'
        );

        foreach ($request_array as $key => $value) {
            $$value = request($value);
        }

        if ($username != '') {
            $where .= "and username like '" . sqlFilter($username) . "%' ";
        }

        if ($contract_name != '') {
            $where .= "and contract_name like '" . sqlFilter($contract_name) . "%' ";
        }

        if ($contract_type != '') {
            $where .= "and contract_type like '" . sqlFilter($contract_type) . "%' ";
        }

        if ($goods_type != '') {
            $where .= "and goods_type like '" . sqlFilter($goods_type) . "%' ";
        }


        return $where;
    }

    /**
     *
     * 删除
     */
    public function delete()
    {
        $ids = request('ids');
        $id_arr = explode(',', $ids);
        $id_clause = '';
        foreach ($id_arr as $id) {
            $id_clause .= "," . sqlFilter($id, 3);
        }
        $id_clause = substr($id_clause, 1);
        $sql = "
			delete from t_purchase_contract where id in ($id_clause)
		";
        $this->db->query($sql);
        $response = array();
        $response['status'] = 'success';
        echo json_encode($response);
    }
}