<?php
/**
 * Thư viện tự xây dựng trong app/TiepProviders/Functions.php
 * Bước 1: composer.json
 * "autoload": {
 *      "files": [
 *          "app/TiepProviders/Functions.php"
 *       ]
 * },
 * Bước 2: chạy lệnh php composer dump-autoload
 */


/**
 * Hàm xóa bỏ dấu Tiếng Việt chuyển thành chuỗi viết thường không dấu
 * @param $str
 * @return bool|mixed|string
 */
function stripUnicode($str)
{
    if (!$str) {
        return false;
    }

    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd' => 'đ',
        'D' => 'Đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i' => 'í|ì|ỉ|ĩ|ị',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );
    foreach ($unicode as $nonUnicode => $uni) {
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }

    return $str;
}

/**
 * Trả về Slug cho title đẹp hơn trên url
 * @param $str : một chuỗi ký tự có đấu
 * @param $modeLower : default to lowercase, 1 to UPPERCASE, 0 to TitleCase
 * @return string
 */
function strToSlug($str, $modeLower = 2)
{
    $str = trim($str);
    if ($str == "") {
        return "";
    }

    $str = str_replace('"', '', $str);
    $str = str_replace("'", '', $str);
    $str = stripUnicode($str);
    if ($modeLower == 2) {
        $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
    } elseif ($modeLower == 0) {
        $str = mb_convert_case($str, MB_CASE_UPPER, 'utf-8');
    } elseif ($modeLower == 1) {
        $str = mb_convert_case($str, MB_CASE_TITLE, 'utf-8');
    }

    $str = str_replace(' ', '-', $str);
    return $str;
}

/**
 * Tạo select bằng đệ quy chính xác Category
 * @param $data : array id, name, parent_id
 * @param int $select
 * @param int $parent
 * @param string $str
 */
function cate($data, $parent = 0, $str = "", $select = 0)
{
    foreach ($data as $value) {
        $id = $value->id;
        $name = $value->name;
        $parent_id = $value->parent_id;
        if ($parent_id == $parent) {
            if ($select != 0 && $id == $select) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else {
                echo "<option value='$id'>$str $name</option>";
            }
            cate($data, $id, $str . "+ ", $select);
        }
    }
}

/**
 * @param $data
 * @param int $parent bat dau tu 0
 * @param string $str dinh dang
 * @param bool $flagIsChild danh dau co la con khong de dinh dang stt trong table
 */
function show_cate($data, $parent = 0, $str = "", $flagIsChild = false)
{
    $i = 0;
    foreach ($data as $item) {
        $id = $item->id;
        $name = $item->name;

        if ($item->parent_id == $parent) {
            if ($flagIsChild) {
                $tab = '--- ';
            }
            else $tab = "";

            echo '<tr class="odd gradeX" align="center">
                     <td>' .$tab . ++$i . '</td> 
                     <td align="left">' . $str . $name . '</td>
                     <td class="center">
                        <i class="fa fa-trash-o fa-fw"></i>
                        <a onclick="return confirmDel(' . "'Có chắc chắn xóa không?'" . ')"
                            href="' . route('getCateDelete', $item->id) . '"> Xóa</a>
                     </td>
                     <td class="center">
                        <i class="fa fa-pencil fa-fw"></i>
                        <a href="' . route('getCateEdit', $item->id) . '"> Sửa</a>
                     </td>
                 </tr>';
            show_cate($data, $id, $str . "--- ", true);
        }

    }
}

/**
 * Hàm tạo mảng menu đa cấp
 * DB:  id, name, url, parent_id
 * @param $array
 * @param int $parent_id
 * @return array
 */
//function ordered_menu($array, $parent_id = 0)
//{
//    $temp_array = array();
//    foreach ($array as $element) {
//        if ($element['parent_id'] == $parent_id) {
//            $element['sub'] = ordered_menu($array, $element['id']);
//            $temp_array[] = $element;
//        }
//    }
//    return $temp_array;
//}

/**
 * Hàm tạo danh sách menu đa cấp html
 * DB:  id, name, url, parent_id
 * @param $array
 * @param int $parent_id
 * @return string
 */
//function html_ordered_menu($array, $parent_id = 0)
//{
//    $menu_html = '<ul>';
//    foreach ($array as $element) {
//        if ($element['parent_id'] == $parent_id) {
//            $menu_html .= '<li><a href="/*' . $element['url'] . '*/">' . $element['name'] . '</a>';
//            $menu_html .= html_ordered_menu($array, $element['id']);
//            $menu_html .= '</li>';
//        }
//    }
//    $menu_html .= '</ul>';
//    $menu_html = str_replace('<ul></ul>', '', $menu_html);
//    return $menu_html;
//}

/**
 * Convert stdClass (dạng kết truy vấn csdl) sang array
 * @param $data
 * @return array
 */
function cvf_convert_object_to_array($data)
{

    if (is_object($data)) {
        $data = get_object_vars($data);
    }

    if (is_array($data)) {
        return array_map(__FUNCTION__, $data);
    } else {
        return $data;
    }
}

/**
 * Hiển thị list menu đa cấp
 * @param $parent
 * @param $level
 */
function display_children($parent, $level)
{
    $sql = 'SELECT a.id, a.label, a.link, Deriv1.Count FROM `menus` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `menus` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.parent=? ORDER BY `sort`';
    $result = DB::select($sql, [$parent]);
    echo "<ul>";
    foreach ($result as $row) {
        $row = cvf_convert_object_to_array($row);
        if ($row['Count'] > 0) {
            echo "<li class='has-sub'><a href='" . $row['link'] . "'>" . $row['label'] . "</a>";
            display_children($row['id'], $level + 1);
            echo "</li>";
        } elseif ($row['Count'] == 0) {
            echo "<li><a href='" . $row['link'] . "'>" . $row['label'] . "</a></li>";
//            echo "<li class='level".$level."'><a class='level".$level."' href='" . $row['link'] . "'>" . $row['label'] . "</a></li>";

        } else;
    }
    echo "</ul>";
}