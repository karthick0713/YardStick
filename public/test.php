<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
#editor {
    min-height: 500px;
}
</style>

<body>

    <select id="languageSelect">
        <option value="customlang">Custom Language</option>
        <option value="abap">ABAP</option>
        <option value="apex">Apex</option>
        <option value="azcli">Azure CLI</option>
        <option value="bat">Batch File</option>
        <option value="bicep">Bicep</option>
        <option value="cameligo">Cameligo</option>
        <option value="clojure">Clojure</option>
        <option value="coffee">CoffeeScript</option>
        <option value="cpp">C++</option>
        <option value="csharp">C#</option>
        <option value="csp">CSP</option>
        <option value="css">CSS</option>
        <option value="dart">Dart</option>
        <option value="dockerfile">Dockerfile</option>
        <option value="ecl">ECL</option>
        <option value="elixir">Elixir</option>
        <option value="flow9">Flow9</option>
        <option value="fsharp">F#</option>
        <option value="go">Go</option>
        <option value="graphql">GraphQL</option>
        <option value="handlebars">Handlebars</option>
        <option value="hcl">HashiCorp Configuration Language</option>
        <option value="html">HTML</option>
        <option value="ini">INI</option>
        <option value="java">Java</option>
        <option value="javascript">JavaScript</option>
        <option value="julia">Julia</option>
        <option value="kotlin">Kotlin</option>
        <option value="less">Less</option>
        <option value="lexon">Lexon</option>
        <option value="liquid">Liquid</option>
        <option value="lua">Lua</option>
        <option value="m3">M3</option>
        <option value="markdown">Markdown</option>
        <option value="mips">MIPS Assembly</option>
        <option value="msdax">MSDAX</option>
        <option value="mysql">MySQL</option>
        <option value="objective-c">Objective-C</option>
        <option value="pascal">Pascal</option>
        <option value="pascaligo">Pascaligo</option>
        <option value="perl">Perl</option>
        <option value="pgsql">PostgreSQL</option>
        <option value="php">PHP</option>
        <option value="pla">PL/I</option>
        <option value="postiats">ATS</option>
        <option value="powerquery">PowerQuery</option>
        <option value="powershell">PowerShell</option>
        <option value="protobuf">Protocol Buffers</option>
        <option value="pug">Pug</option>
        <option value="python">Python</option>
        <option value="qsharp">Q#</option>
        <option value="r">R</option>
        <option value="razor">Razor</option>
        <option value="redis">Redis</option>
        <option value="redshift">Amazon Redshift</option>
        <option value="restructuredtext">reStructuredText</option>
        <option value="ruby">Ruby</option>
        <option value="rust">Rust</option>
        <option value="sb">SB</option>
        <option value="scala">Scala</option>
        <option value="scheme">Scheme</option>
        <option value="scss">SCSS</option>
        <option value="shell">Shell</option>
        <option value="solidity">Solidity</option>
        <option value="sophia">Sophia</option>
        <option value="sparql">SPARQL</option>
        <option value="sql">SQL</option>
        <option value="st">Structured Text (IEC 61131-3)</option>
        <option value="swift">Swift</option>
        <option value="systemverilog">SystemVerilog</option>
        <option value="tcl">Tcl</option>
        <option value="twig">Twig</option>
        <option value="typescript">TypeScript</option>
        <option value="vb">Visual Basic</option>
        <option value="xml">XML</option>
        <option value="yaml">YAML</option>
        <!-- Add more language options as needed -->
    </select>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>

    <!-- Your HTML structure -->
    <div id="editor"></div>

    <script>
    $(document).ready(function() {
        // Initialize Ace Editor
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/dracula"); // Set the 'dracula' theme for dark mode
        editor.session.setMode("ace/mode/php"); // Set the PHP mode

        // Example: Get the current code from the editor
        var userCode = editor.getValue();

        // Change language based on selection (optional)
        var languageSelect = $("#languageSelect");
        languageSelect.change(function() {
            var selectedLanguage = languageSelect.val();
            editor.session.setMode("ace/mode/" + selectedLanguage);
        });
    });
    </script>
</body>

</html>