<h1>Variables</h1>

<h2>Unknow variable</h2>

<p>
    Must be empty : [{$unknow}]
</p>

<h2>Misc</h2>

<p>
    Print « Lorem ipsum dolor sit amet » for each line (different case) :
</p>

<pre>
    1. {$a}
    2. {$a|upper}
    3. {$a|upper|print}
    4. {$a (Default text)}
    5. {$a(Default text)}
    6. {$a (Default text lower|)|)| lower|ucwords }
    7. {$a (Default text lower|)}
    8. {$a|print|print|lower|print|ucwords}
</pre>


<h2>Variable setter</h2>


<h3>SetVar function</h3>

Multiline :

{!setvar:multi1, 'test on
2 line'}

<pre>
{$multi1}
</pre>

{!setvar:multi1, "test on
2 line with double-quote"}

<pre>
{$multi1}
</pre>

{!setvar:multi2, 'test on 2 line
with special char: "\}{\} <!-- -->\'---
'}

<pre>
{$multi2}
</pre>

<ul>
    <li>No data (must be empty) : {$varsetter}</li>
    <li>No data with default value : {$varsetter (<span class="ok">Default value !</span>)}</li>
    <li>No data with default value and special character : {$varsetter (<span class="ok">Default value ) " ' \})\|toto !</span>)}</li>
    <li>Default l10n : {$empty _(Hello)}</li>
    <li>{!setvar:'varsetter','<span class="ok">Ok</span>'} Data : {$varsetter}</li>
    <li>Data with default value : {$varsetter (Default value)}</li>
    <li>{!setvar:'varsetter','<span class="ok">Ok \} \' "</span>'} Data with special character : {$varsetter}</li>
</ul>

<h3>&xxx:yyy</h3>

<ul>
    <li>No data : {$varsetter1}</li>
    <li>No data with default value : {$varsetter1 (Coucou !)}</li>
    <li>No data with default value and {} : {$varsetter1 (Coucou \} !)}</li>
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
    <li>Default value : {$neversetted (Hello world)}</li>
</ul>

<h2>Function</h2>

<ul>
    <li>« test » : {$test|test:'ok','<span class="ok">OK</span>','<span class="ko">Error</span>'}</li>
    <li>« test » : {$test|test:'ko','<span class="ko">Error</span>','<span class="ok">OK</span>'}</li>
    <li>String function ({$words}) :
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
