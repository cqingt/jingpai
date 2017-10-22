<?php

class cache {

    var $db;
    var $cachefile;

    function cache(& $db) {
        $this->db = $db;
    }

    function getfile($cachename) {
        $this->cachefile = ASK2_ROOT . '/data/cache/' . $cachename . '.php';
    }

    function isvalid($cachename, $cachetime) {
        if (0 == $cachetime)
            return true;
        $this->getfile($cachename);
        if (!is_readable($this->cachefile) || $cachetime < 0) {
            return false;
        }
        clearstatcache();
        return (time() - filemtime($this->cachefile)) < $cachetime;
    }

    function read($cachename, $cachetime=0) {
        $this->getfile($cachename);
        if ($this->isvalid($cachename, $cachetime)) {
            return @include $this->cachefile;
        }
        return false;
    }

    function write($cachename, $arraydata) {
        $this->getfile($cachename);
        if (!is_array($arraydata))
            return false;
        $strdata = "<?php\nreturn " . var_export($arraydata, true) . ";\n?>";
        $bytes = writetofile($this->cachefile, $strdata);
        return $bytes;
    }

    function remove($cachename) {
        $this->getfile($cachename);
        if (file_exists($this->cachefile)) {
            unlink($this->cachefile);
        }
    }

    function load($cachename, $id='id', $orderby='') {
        $arraydata = $this->read($cachename);
        if (!$arraydata) {
            $sql = 'SELECT * FROM ' . DB_TABLEPRE . $cachename;
            $orderby && $sql.=" ORDER BY $orderby ASC";
            $query = $this->db->query($sql);
            while ($item = $this->db->fetch_array($query)) {
                if (isset($item['k'])) {
                    $arraydata[$item['k']] = $item['v'];
                } else {
                    $arraydata[$item[$id]] = $item;
                }
            }
            if( $cachename == 'setting' ){
                $sql = 'SELECT * FROM ' . DB_TABLEPRE_SHOP . $cachename;
                $query = $this -> db -> query($sql);
                $data = array();
                while( $item = $this->db->fetch_array($query) ){
                    $data[$item['name']] = $item['value'];
                }
                $arraydata['mailserver'] = $data['email_host'];
                $arraydata['mailport'] = $data['email_port'];
                $arraydata['mailfrom'] = $data['email_addr'];
                $arraydata['mailauth_username'] = $data['email_id'];
                $arraydata['mailauth_password'] = $data['email_pass'];
            }
            $this->write($cachename, $arraydata);
        }
        return $arraydata;
    }

}

?>