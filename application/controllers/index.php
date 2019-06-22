<?php

/**
 * @OA\Info(title="My First API", version="0.1")
 */
class index extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @OA\Get(
     *     path="/api/resource.json",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function appmsg()
    {

    }

    /**
     * @OA\Get(
     *     path="/customer/info",
     *     summary="用户的个人信息",
     *     description="这不是个api接口,这个返回一个页面",
     *     @OA\Parameter(name="userId", in="query", @OA\Schema(type="string"), required=true, description="用户ID"),
     *     @OA\Response(
     *      response="200",
     *      description="An example resource"
     *     )
     * )
     */
    public function index()
    {

        $sub_title = request("sub_title");//导航栏标签
        if ($sub_title == "") {//默认首页
            $sub_title = "doc";
        }
        $data = array();
        $data['sub_title'] = $sub_title;
        $this->load->helper('url');
        $this->load->view('top', $data);
        if ($sub_title == "doc") {
            $this->load->view('left_doc');
            $this->load->view('index_frame');
        } else if ($sub_title == "example") {
            $this->load->view('left_example');
            $this->load->view('index_frame');
        } else if ($sub_title == "manage") {
            $this->load->view('left_manage');
            $this->load->view('index_frame');
        }
        $this->load->view('foot');
    }
}
