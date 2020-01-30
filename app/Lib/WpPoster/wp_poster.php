<?php
/**
 * Класс для постинга в блоги
 * @author CharnaD
 * @license Свободное использование с указанием ссылки на автора.
 * Я, как автор не несу ни малейшей ответственности.
 * @license Link me and do what the fuck you want. I'm not responsible for anything.
 * @link http://www.charnad.com/
 * @version -1
 *
 */
class wp_poster {

	/**
     * Массив постов для отправки в блог
     * @var array
     */
    private $posts = array();

    /**
     * Массив блогов, если постим сразу в несколько.
     * @var array
     */
    private $blogs = array();

    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
        	self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {}
    private function __clone() {}

    private function _isUTF8($string) {
        return preg_match('%(?:
        [\xC2-\xDF][\x80-\xBF]
        |\xE0[\xA0-\xBF][\x80-\xBF]
        |[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}
        |\xED[\x80-\x9F][\x80-\xBF]
        |\xF0[\x90-\xBF][\x80-\xBF]{2}
        |[\xF1-\xF3][\x80-\xBF]{3}
        |\xF4[\x80-\x8F][\x80-\xBF]{2}
        )+%xs', $string);
    }

    /**
     * Добавляет блог в массив блогов. Инициализирует адрес блога, пользователя, пароль и ID блога.
     * 0 для отдельностоящего wordpress, 0 по умолчанию.
     *
     * @param String $url
     * @param String $username
     * @param String $password
     * @param Int $blog_id = 0
     */
    public function addBlog(wp_blog $blog) {
        $this->blogs[] = $blog;
        return true;
    }

    public function addPost(wp_post $post) {
        $this->posts[] = $post;
        return true;
    }

    public function addBlogs($blogs) {
    	$result = true;
        foreach ($blogs as $blog) {
    	   $result = $result && $this->addBlog($blog);
        }
        return $result;
    }

    public function addPosts($posts) {
        $result = true;
        foreach ($posts as $post) {
        	$result = $result && $this->addPost($post);
        }
        return $result;
    }

	public function createCategories(wp_blog $blog, array $cats) {
		$errors = array();
        foreach ($cats as $cat) {
            $cat_structure = array('name' => $cat);
            $result = $blog->client->query("wp.newCategory", $blog->id, $blog->username, $blog->password, $cat_structure);
            if (!$result) {
                $errors[] = "Категория '{$cat}' не создана!";
            }
        }
        return count($errors)?$errors:true;
	}

	public function massCreateCategories(array $cats) {
        foreach ($this->blogs as $blog) {
            $results[] = $this->createCategories($blog, $cats);
        }
        return $results;
    }


	public function getCategories (wp_blog $blog) {
        return $res = $blog->client->query("metaWeblog.getCategories", $blog->id, $blog->username, $blog->password);
	}

	public function post(wp_blog $blog, wp_post $post) {
		$responses = array();
		$post_array = $post->getArray();

	    $result = $blog->client->query("metaWeblog.newPost", $blog->id, $blog->username, $blog->password, $post_array, $post_array['published']);
	    if ($result) {
	        $responses[] = 'OK';
	    } else {
		    	//TODO Разобраться с тем, как класс возвращает ошибку. Через какие функции.
//	        if (is_array($blog->client->getResponse())) {
//	           $responses[] = implode(':', $blog->client->getResponse());
//	        } else
		    if (is_array($blog->client->getErrorMessage())) {
		        $responses[] = implode(':',$blog->client->getErrorMessage());
		    } else {
		        $responses[] = var_dump($blog->client->getErrorMessage());
		    }
        }

        return $responses;
	}

	public function massPost(array $blogs, array $posts) {
        $responses = array();
        foreach ($posts as $post) {
        	foreach ($blogs as $blog) {
        		$responses[] = $this->post($blog, $post);
        	}
        }

        return $responses;
	}

}

class wp_post {

	private $post = array();

	//published : 0,1
	public function __construct() {
		$argc = func_num_args();
		$argv = func_get_args();

		if ($argc == 1 && is_array($argv[0]) && isset($argv[0]['title'], $argv[0]['description'])) {
            $this->post = $argv[0];
        }
    }

    public function setVal($arg, $val) {
        $post[strval($arg)] = $val;
    }

    public function setArray($array) {
        if (is_array($array) && isset($array['title'], $array['description'])) {
            $this->post = $array;
        }
    }

    public function getArray() {
        if (!isset($this->post['title'], $this->post['description'])) {
        	return false;
        }
    	return $this->post;
    }

}

class wp_blog {

	/**
     * Имя пользователя блога
     * @var String
     */
    public $username = '';

    /**
     * Пароль пользователя блога
     * @var String
     */
    public $password='';

    /**
     * Адрес xmlrpc.php в блоге
     *
     * @var unknown_type
     */
	public $url = '';

	/**
     * ID блога, по умолчанию 0
     * @var int
     */
    public $id = 0;

     /**
     * IXR_Client, для которого предназначен этот API
     * @var IXR_Client
     */
    public $client;

    public function __construct($url, $username, $password, $id){
    	//TODO проверять урл
        if (strlen($url)) {
        	$this->url = $url;
        }

        if (strlen($username)) {
        	$this->username = $username;
        }

        if (strlen($password)) {
        	$this->password = $password;
        }

        if ($id != 0) {
        	$this->id = $id;
        }

        $this->client = new IXR_Client($url);
    }

    public function wp_createCategories(array $cats) {
        $errors = array();
        foreach ($cats as $cat) {
        	if (is_array($cat)) {
        		if (!isset($cat['name'])) {
        		    $errors[] = "Не задано имя категории!";
        		    continue;
        		} else {
        			$cat_structure = array('name' => $cat['name']);
        		}
		        if (isset($cat['slug']) && strlen($cat['slug'])) {
		            $cat_structure['slug'] = $cat['slug'];
		        }
		        if (isset($cat['parent_id']) && strlen($cat['parent_id'])) {
		            $cat_structure['parent_id'] = intval($cat['parent_id']);
		        }
		        if (isset($cat['description']) && strlen($cat['description'])) {
		            $cat_structure['description'] = $cat['description'];
		        }
        	} elseif (is_string($cat)) {
                $cat_structure = array('name' => $cat);
        	}
            $result = $this->client->query("wp.newCategory", $this->id, $this->username, $this->password, $cat_structure);
            if (!is_int($result)) {
            	//TODO все ли правильно тут с эррорами? оказывается нет.. короче надо изучить
                $errors[] = "Категория '{$cat}' не создана! ";
            } else {
            	$results[] = $result;
            }
        }
        return count($errors)?$errors:$results;
    }

    public function wp_getCategories () {
        $res = $this->client->query("metaWeblog.getCategories", $this->id, $this->username, $this->password);
        return $res ? $this->client->getResponse() : false;
    }

    public function wp_getCatNames() {
        $res = $this->client->query("metaWeblog.getCategories", $this->id, $this->username, $this->password);
        if (!$res) {
        	return false;
        }

        $cats_array = array();
        foreach ($this->client->getResponse() as $cat) {
            $cats_array[] = $cat['categoryName'];
        }

        return $cats_array;
    }

    public function wp_newCategory($name, $slug = '', $parent_id = '', $description = '') {
        $cat_struct['name'] = $name;
        if (strlen($slug)) {
            $cat_struct['slug'] = $slug;
        }
        if (strlen($parent_id)) {
        	$cat_struct['parent_id'] = intval($parent_id);
        }
        if (strlen($description)) {
        	$cat_struct['description'] = $description;
        }
    	return $this->client->query("wp.newCategory", $this->id, $this->username, $this->password, $cat_struct);
    }

    public function wp_deleteCategory($id) {
        $result = $this->client->query("wp.deleteCategory", $this->id, $this->username, $this->password, $id);
        return $result ? $this->client->getResponse() : false;
    }

    public function wp_getCommentCount($post_id) {
        $result = $this->client->query("wp.getCommentCount", $this->id, $this->username, $this->password, $post_id);
        return $result ? $this->client->getResponse() : false;
    }

    public function wp_getOptions($options) {
        $result = $this->client->query("wp.getOptions", $this->id, $this->username, $this->password, $options);
        return $result ? $this->client->getResponse() : false;
    }

    public function wp_setOptions() {

    }

    public function wp_getPage($page_id) {
    	$result = $this->client->query("wp.getPage", $this->id, intval($page_id), $this->username, $this->password);
        return $result ? $this->client->getResponse() : false;
    }

    public function wp_getPages() {
        $result = $this->client->query("wp.getPages", $this->id, $this->username, $this->password);
        return $result ? $this->client->getResponse() : false;
    }

    public function wp_newPage() {

    }
//TODO разобраться с getErrorMessage везде
}
?>