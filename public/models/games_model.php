<?php
class Games_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getGames()
    {
		//$Return = $this->db->select("select * from creditorinfo");
		//return json_encode($Return);
	}

	public  function getBlogs(){
        $Return = $this->db->select("SELECT
    p.id,
    p.post_name,
    p.post_title,
    p.post_date,
    p.post_modified,
    p.post_type,
    p.post_status,
    c.name,
    GROUP_CONCAT(t.`name`) as tags
FROM wp_posts p
JOIN wp_term_relationships cr
    ON (p.`id`=cr.`object_id`)
LEFT JOIN wp_term_taxonomy ct
    ON (ct.`term_taxonomy_id`=cr.`term_taxonomy_id`
    AND ct.`taxonomy`='category')
LEFT JOIN wp_terms c ON
    (ct.`term_id`=c.`term_id`)
LEFT JOIN wp_term_relationships tr
    ON (p.`id`=tr.`object_id`)
LEFT JOIN wp_term_taxonomy tt
    ON (tt.`term_taxonomy_id`=tr.`term_taxonomy_id`
    AND tt.`taxonomy`='post_tag')
LEFT JOIN wp_terms t
    ON (tt.`term_id`=t.`term_id`)
WHERE p.post_status='publish' 
GROUP BY p.id ORDER BY p.ID DESC 
");
        return json_encode($Return);
    }
	
} // End Class 