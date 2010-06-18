
<h1>Functions</h1>

<h2>Include</h2>

{!include:include1.tpl}

<h2>Import</h2>

{!import:./import.tpl}
{!import:import2.tpl}

{!print:'paf','pif',"pouf"|upper}

<ul>
    <li>« html errors » : {!errors}</li>
    <li>« normal errors » : {!errors:'0'}</li>
    <li>« cycle » : <!-- BEGIN cycle --><span style="color: {!cycle:'green','blue'}">Test</span> <!-- END cycle --></li>
    <li>External : {!printo}</li>
</ul>

<hr />

