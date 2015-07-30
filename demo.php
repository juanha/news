<?php
//发布信息
if ($_POST['type'] == 'add') {
    $name = isset($_POST['name']) && trim($_POST['name']) ? trim($_POST['name']) : showmessage(L('name') . L('empty'));
    $kbs = isset($_POST['kbs']) && trim($_POST['kbs']) ? trim($_POST['kbs']) : showmessage(L('标题') . L('empty'));
    $content = isset($_POST['content']) && trim($_POST['content']) ? trim($_POST['content']) : showmessage(L('内容') . L('empty'));
    $inputtime = SYS_TIME;
    $username = $this->username;
    if ($this->db->insert(array('department' => $name, 'check_status' => 0, 'art_type' => 4, 'art_title' => $kbs, 'art_content' => $content, 'art_time' => $inputtime, 'poster' => $username))) {
        showmessage(L('operation_success'), '?m=manage&c=manage&a=init', '', 'add');
    } else {
        showmessage(L('operation_failure'));
    }
}
//更新信息

if ($_POST['type'] == 'edit') {
    $id = isset($_GET['id']) && intval($_GET['id']) ? intval($_GET['id']) : showmessage(L('illegal_parameters'), HTTP_REFERER);
    if ($data = $this->db->get_one(array('art_id' => $id))) {
        $name = isset($_POST['name']) && trim($_POST['name']) ? trim($_POST['name']) : showmessage(L('name') . L('empty'));

        $title = isset($_POST['title']) && trim($_POST['title']) ? trim($_POST['title']) : showmessage(L('标题') . L('empty'));

        $content = isset($_POST['content']) && trim($_POST['content']) ? trim($_POST['content']) : showmessage(L('内容') . L('empty'));
        $username = $this->username;
        $inputtime = SYS_TIME;
        $sql = array('department' => $name, 'check_status' => 0, 'art_type' => 4, 'art_title' => $title, 'art_content' => $content, 'art_time' => $inputtime, 'poster' => $username);
        if ($this->db->update($sql, array('art_id' => $tpid))) {
            showmessage(L('operation_success'), '', '', 'edit');
        } else {
            showmessage(L('operation_failure'));
        }
    } else {
        $show_validator = $show_scroll = $show_header = true;
        pc_base::load_sys_class('form', '', 0);
        include $this->admin_tpl('template_edit');
    }
} else {
    showmessage(L('notfound'), HTTP_REFERER);
}
//删除一条或多条信息
if ($_POST['type'] == 'delete') {
    $ids = $_GET['id'];
    if (is_array($ids)) {
        foreach ($ids as $id) {
            if ($this->db->get_one(array('art_id' => $id))) {
                $this->db->delete(array('art_id' => $id));
            } else {
                showmessage(L('notfound'), HTTP_REFERER);
            }
        }
        showmessage(L('operation_success'), HTTP_REFERER);

    } elseif (is_numeric($ids)) {
        $id = intval($ids);
//删除
        if ($this->db->get_one(array('art_id' => $id))) {
            if ($this->db->delete(array('art_id' => $id))) {
                showmessage(L('operation_success'), HTTP_REFERER);
            } else {
                showmessage(L('operation_failure'), HTTP_REFERER);
            }
        } else {
            showmessage(L('notfound'), HTTP_REFERER);
        }

    }
} else {
    showmessage(L('illegal_operation'));
}

?>




