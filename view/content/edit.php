<?php

namespace Anax\View;

?>

<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="contentId" value="<?= $id ?>" required/>

    <p>
        <label>Title:<br> 
        <input type="text" name="contentTitle" value="<?= $title ?>"/>
        </label>
    </p>

    <p>
        <label>Path:<br> 
        <input type="text" name="contentPath" value="<?= $path ?>"/>
    </p>

    <p>
        <label>Slug:<br> 
        <input type="text" name="contentSlug" value="<?= $slug ?>"/>
    </p>

    <p>
        <label>Text:<br> 
        <textarea name="contentData"><?= $data ?></textarea>
     </p>

     <p>
         <label>Type:<br> 
         <input type="text" name="contentType" value="<?= $type ?>"/>
     </p>

     <p>
         <label>Filter: (bbcode, link, markdown, nl2br)<br> 
         <input type="text" name="contentFilter" value="<?= $filter ?>" required autocomplete="off" placeholder="bbcode,nl2br"/>
     </p>

     <p>
         <label>Publish:<br> 
         <input type="datetime" name="contentPublish" value="<?= $published ?>"/>
     </p>

    <p>
        <button type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </p>
    </fieldset>
</form>
