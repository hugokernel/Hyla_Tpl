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

<h1>Variables</h1>

<h2>Unknow variable</h2>

[{$unknow}]

<h2>Variable setter</h2>


<h3>SetVar function</h3>

Multiline :

{!setvar:multi1, 'test on
2 line'}

<p>
    {$multi1}
</p>

{!setvar:multi2, 'test on 2 line
    with special char: "\}{\} <!-- -->
'}

<p>
    {$multi2}
</p>

<ul>
    <li>No data : {$varsetter}</li>
    <li>No data with default value : {$varsetter:Default value !}</li>
    <li>No data with default value and special character : {$varsetter:Default value " ' \} !}</li>
    <li>{!setvar:'varsetter','<span class="ok">Ok</span>'} Data : {$varsetter}</li>
    <li>{!setvar:'varsetter','<span class="ok">Ok \} ' "</span>'} Data with special character  : {$varsetter}</li>
    <li>Data with default value : {$varsetter:Default value}</li>
</ul>

<h3>{&xxx:yyy} </h3>

<ul>
    <li>No data : {$varsetter1}</li>
    <li>No data with default value : {$varsetter1:Coucou !}</li>
    <li>No data with default value and {} : {$varsetter1:Coucou \} !}</li>
    <li>{&varsetter1:<span class="ok">Ok</span>} Data : {$varsetter1}</li>
    <li>Data with default value : {$varsetter1:Default value}</li>
    <li>{&varsetter2:<span class="ok">Ok ' " \}</span>} Data2 with special character : {$varsetter2}</li>
</ul>

<h2>Misc</h2>

<ul>
    <li>Var test#1 : {$test}</li>
    <li>Var test#2 : {$test}</li>
    <li>Var test1 : {$test1}</li>
    <li>Var test2 : {$test2}</li>
    <li>Default value : {$neversetted:Hello world}</li>
</ul>

<h2>Function</h2>

<ul>
    <li>« test » : {$test|test:'ok','<span class="ok">OK</span>','<span class="ko">Error</span>'}</li>
    <li>« test » : {$test|test:'ko','<span class="ko">Error</span>','<span class="ok">OK</span>'}</li>
    <li>String function :
        <ul>
            <li>« ucfirst » : {$words|ucfirst}</li>
            <li>« ucwords » : {$words|ucwords}</li>
            <li>« upper » : {$words|upper}</li>
            <li>« lower » : {$words|lower}</li>
            <li>« escape » : <span class="ok">{$escape|escape}</span></li>
            <li>« ltrim » : |{$trim|ltrim}|</li>
            <li>« rtrim » : |{$trim|rtrim}|</li>
            <li>« trim » : |{$trim|trim}|</li>
            <li>Mix (trim|lower|ucwords|escape) : {$words|trim|lower|ucwords|escape}</li>
        </ul>
    </li>
</ul>

<hr />

<h1>Functions</h1>

<h2>Include</h2>

{!include:include1.tpl}

<h2>Import</h2>

{!import:./import.tpl}
{!import:import2.tpl}

<ul>
    <li>« html errors » : {!errors}</li>
    <li>« normal errors » : {!errors:0}</li>
    <li>« cycle » : <!-- BEGIN cycle --><span style="color: {!cycle:'green','blue'}">Test</span> <!-- END cycle --></li>
    <li>External : {!printo}</li>
</ul>

<hr />

<h1>Block</h1>

<!-- BEGIN never.called -->
<span class="ko">Block never called !</span>
<!-- ELSE never.called -->
<span class="ok">Block never called else !</span>
<!-- END never.called -->

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

<a href="?dir={$dir}&lang={$lang_switch}">{_Switch lang} : {$lang_switch}</a>

<table width="50%">
    <tr>
        <th width="90%">{_Name}</th>
        <th width="10%">{_Size}</th>
    </tr>
    
    <!-- BEGIN table.line -->
    <tr style="background-color: #{!cycle:'DDD', 'AAA'};">
        <td align="left">
            <!-- BEGIN table.line.dir -->
            <a href="?dir={$file.path}&lang={$lang}"><strong>{$file.name}</strong></a>
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
