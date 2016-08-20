#!/usr/bin/env php
<?php

$root=realpath(dirname(__FILE__)."/../");
if(isset($argv[1])) {
    $base=$argv[1];
} else {
    $base="https://leftwinghacker.github.io";
}

$files=[]; //Files to render
$toc=""; //TOC html

//Build a TOC, and fill $files so that we can render without recursion
function buildTOC($element,$parentPath=[]) {
    global $files;
    $path=$element->id;
    if(sizeof($parentPath)!=0) {
        $path=implode("-",$parentPath)."-".$path;
        $element->file=implode("/",array_merge(array_slice($parentPath,1),[$element->id.".html"]));
    } else { //Index file only
        $element->file=$element->id.".html";
    }
    if(!isset($element->template))
        $element->template="default";
    $files[]=[
        "file"=>$element->file,
        "title"=>$element->title,
        "page_id"=>implode("-",array_merge(array_slice($parentPath,1),[$element->id])),
        "template"=>$element->template,
    ];
    $tabs=str_repeat("\t",sizeof($parentPath));
    $ret="$tabs<li>\n";
    $ret.="$tabs<a href=\"{$element->file}\">{$element->title}</a>\n";
    if(isset($element->children) && sizeof($element->children)>0) {
        $ret.="$tabs<ol>\n";
        foreach($element->children as $child) {
            $ret.=buildTOC($child,array_merge($parentPath,[$element->id]));
        }
        $ret.="$tabs</ol>\n";
    }
    $ret.="$tabs</li>\n";
    return $ret;
}

//Render references block
function renderRefs($refs) {
    $ret="<h2>Referenzen</h2>\n";
    $ret.="<ol class=\"refs\">\n";
    foreach($refs as $id=>$ref) {
        $ret.="\t<li><a id=\"ref-$id\" href=\"{$ref[0]}\">{$ref[1]}: {$ref[2]}</a>\n";
    }
    $ret.="</ol>\n";
    return $ret;
}

//Render the individual pages
function renderFiles($files,$toc) {
    global $root;
    global $base;
    $templates=[]; //cache template html
    foreach($files as $file) {
        $tplfile="$root/_templates/{$file['template']}.html";
        if(!isset($templates[$tplfile])) {
            $templates[$tplfile]=file_get_contents($tplfile);
        }
        $infile="$root/_fragments/{$file['file']}";
        $outfile="$root/{$file['file']}";
        $outdir=dirname($outfile);
        $content=file_get_contents($infile);
        $out=$templates[$tplfile];
        //Replace fixed replacements
        //Dynamic replacements
        $refs=[];
        $content=preg_replace_callback("@{ref (.*) '(.*)' '(.*)'}@isU",function($hit) use(&$refs,$file) { //References
            $refs[]=array_slice($hit,1);
            return "<sup class=\"ref\">[<a href=\"{$file['file']}#ref-".(sizeof($refs)-1)."\">".sizeof($refs)."</a>]</sup>";
        },$content);
        if(sizeof($refs)>0) {
            $content.=renderRefs($refs);
        }
        $out=str_replace('{content}',$content,$out);
        $out=str_replace('{toc}',$toc,$out);
        $out=str_replace('{base}',$base,$out);
        $out=str_replace('{title}',$file["title"],$out);
        $out=str_replace('{pageid}',$file["page_id"],$out);

        if(!is_dir($outdir)) {
            mkdir($outdir,0777,true);
        }
        $fp=fopen($outfile,"w");
        fwrite($fp,$out);
        fclose($fp);
    }
}

$content=json_decode(file_get_contents("$root/content.json"));
$toc=buildTOC($content);
renderFiles($files,$toc);
