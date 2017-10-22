<?php
/**
 * 服务中心
 *
 *
 *
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');

class servicecenterModel{
	/**
	 * 查询
	 *
	 * @param array $condition 检索条件
	 * @return array 数组结构的返回结果
	 */
	public function getArticleList($condition){
		$param = array();
		$param['table'] = 'article';
		$param['field'] = isset($condition['field']) ? $condition['field'] : '*';
		$param['where'] = $condition['where'];
		$param['order']	= (empty($condition['order'])?'article_sort asc,article_time desc':$condition['order']);
        $param['limit']	= empty($condition['limit'])?'':$condition['limit'];
		$result = Db::select($param);
		return $result;
	}

    /**
     * 联表查询
     * @param $condition
     * @return array|mixed
     */
	public function getArticleJoinList($condition){
        $param	= array();
        $param['table'] = 'article,article_class';
        $param['field']	= empty($condition['field'])?'*':$condition['field'];;
        $param['join_type']	= empty($condition['join_type'])?'left join':$condition['join_type'];
        $param['join_on']	= array('article.ac_id=article_class.ac_id');
        $param['where'] = $condition['where'];
        $param['order']	= empty($condition['order'])?'article.article_sort':$condition['order'];
        $param['limit']	= empty($condition['limit'])?'':$condition['limit'];
        $result = Db::select($param);
        return $result;
    }

    /**
     * 查询一条分类
     * @param $condition
     * @return mixed
     */
    public function getArticleClassOne($condition){
        $param	= array();
        $param['table'] = 'article_class';
        $param['field']	= empty($condition['field'])?'*':$condition['field'];
        $param['where'] = $condition['where'];
        $param['order']	= empty($condition['order'])?'ac_parent_id asc,ac_sort asc,ac_id asc':$condition['order'];
        $param['limit'] = 1;
        $result = Db::select($param);
        return $result[0];
    }

    /**
     * 根据文章ID查询文章详细信息
     * @param $article_id
     * @return mixed
     */
    public function getArticleContent($article_id){
        $param = array();
        $param['table'] = 'article';
        $param['field'] = 'article_content,ac_id,article_title,article_id,article_url';
        $param['where'] = 'article_id = '.$article_id;
        $param['limit'] = 1;
        $result = Db::select($param);
        return $result[0];
    }

    /**
     * 根据分类ID查询该分类下所有文章名称及ID
     * @param $ac_id
     * @return array|mixed
     */
    public function getArticleName($ac_id){
        $param	= array();
        $param['table'] = 'article,article_class';
        $param['field']	= 'article_id,article_title,ac_name,article.ac_id,article_url';
        $param['join_type']	= 'left join';
        $param['join_on']	= array('article.ac_id=article_class.ac_id');
        $param['where'] = 'article.ac_id = '. $ac_id . ' and article_show = 1';
        $param['order']	= 'article.article_sort';
        $result = Db::select($param);
        return $result;
    }

    /**
     * 根据文章标题查询该文章的详细信息
     * @param $article_title
     * @return mixed
     */
    public function getArticleId($article_title){
        $param = array();
        $param['table'] = 'article';
        $param['field'] = 'article_content,ac_id,article_title,article_id,article_url';
        $param['where'] = "article_title = '".$article_title . "'";
        $param['limit'] = 1;
        $result = Db::select($param);
        return $result[0];
    }
}