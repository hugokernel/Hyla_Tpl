<html>

<head>
    <title>{$title}</title>

    <style type="text/css" media="screen">
        .ko {
            color: red;
        }

        .ok, blockquote {
            color: green;
        }
    </style>

</head>

<body>

Hyla_Tpl version {$VERSION}

{!include:variable.tpl}

{!include:function.tpl}

<h1>Block</h1>

<!-- BEGIN never.called -->
<span class="ko">Block never called !</span>
<!-- ELSE never.called -->
<span class="ok">Block never called else !</span>
<!-- END never.called -->

<!-- BEGIN block.always.called -->
<p>
    <span class="ok">Block always called !</span>
</p>
<!-- ELSE block.always.called -->
<span class="ko">Block always called else !</span>
<!-- END block.always.called -->

<!-- BEGIN get -->
    <span class="ok">Get content</span>
<!-- END get -->

<p>
    {$get}
</p>

<!-- BEGIN b1 -->
<blockquote>Niveau 1
    <!-- BEGIN b2 -->
    <blockquote>Niveau 2
        <!-- BEGIN b3 -->
        <blockquote>Niveau 3
            <!-- BEGIN b4 -->
            <blockquote>Niveau 4</blockquote>
            <!-- ELSE b4 -->
            Else block b4
            <!-- END b4 -->
        </blockquote>
        <!-- END b3 -->
    </blockquote>
    <!-- ELSE b2 -->
    <span class="ko">Error !</span>
    <!-- END b2 -->
</blockquote>
<!-- END b1 -->

<h2>Blocks with default values</h2>
<pre><code>
$lines = array(
    0 => array(
        'text' => null
    ),
    1 => array(
        'text' => ''
    ),
    2 => array(
        'text' => false
    ),
    3 => array(
        'text' => 0
    ),
    4 => array(
        'text' => 'some text'
    )
);
</code></pre>

<!-- BEGIN block_with_defaults -->
<p>line  = {$line.text (<span class="ok">(default value)</span>)}</p>
<!-- END block_with_defaults -->

<a href="?dir={$dir}&lang={$lang_switch}">{_Switch lang} : {$lang_switch}</a>

<table width="50%" id="tree">
    <tr>
        <th width="90%">{_Name}</th>
        <th width="10%">{_Size}</th>
    </tr>
    
    <!-- BEGIN table.line -->
    <tr style="background-color: #{!cycle:'DDD', 'AAA'};">
        <td align="left">
            <!-- BEGIN table.line.dir -->
            <a href="?dir={$file.path}&lang={$lang}#tree"><strong>{$file.name}</strong></a>
            <!-- ELSE table.line.dir -->
            <strong>{$file.name}</strong>
            <!-- END table.line.dir -->
        </td>
        <td align="right">
            {$file.size|humansize}
        </td>
    </tr>
    <!-- END table.line -->
</table>

</body>

</html>
