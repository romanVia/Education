<?php

class NewsView
    implements Iterator
{
    const PATH = __DIR__ . '/../views/';

    protected $data = [];

    public function __set($key, $val)
    {
        $this->data[$key] = $val;
    }

    public function __get($key)
    {
        return $this->data[$key];
    }

    public function render($template)
    {
        foreach ($this->data as $key => $val) {
            $$key = $val;
        }

        ob_start();
        include $this::PATH . $template;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public function display($template)
    {
//        echo $this->render($template);
        foreach ($this->data as $key => $val) {
            $$key = $val;
        }
        include $this::PATH . $template;
    }

    public function current()
    {
        return current($this->data);
    }

    public function next()
    {
        return next($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function valid()
    {
        $key = key($this->data);
        return $key !== NULL && $key !== FALSE;
    }

    public function rewind()
    {
        reset($this->data);
    }
}
