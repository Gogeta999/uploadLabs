<?php
include 'config.php';
include 'head.php';
include 'menu.php';
?>
<style type="text/css">
#head_menu a{
	display: none;
}
</style>

<div id="upload_panel">
    <ol>
        <li>
            <h3>Introduction</h3>
            <p><code>upload-labs</code>is a website that uses<code>php</code>built，A firing range dedicated to collecting the various upload vulnerabilities encountered in penetration testing and CTF. It is designed to help you have a comprehensive understanding of upload vulnerabilities. There are currently 21 levels, each containing a different upload method.</p>
        </li>
        <li>
            <h3>Note</h3>
            <p>1.There is no fixed method for passing each level, so don't limit your own thinking!</p>
            <p>2.This project provide<code>writeup</code>is just a example，I hope you can pass with another methos and share your ideas on how to get through.</p>
            <p>3.When you have no idea，You can click<code>View tips</code>。</p>
            <p>4.If you really can't do it，You can click<code>View Source Code</code>。</p>
        </li>
        <!-- <li>
            <h3>后续</h3>
            <p>如在渗透测试实战中遇到新的上传漏洞类型，会更新到<code>upload-labs</code>中。当然如果你也希望参加到这个工作当中，欢迎<code>pull requests</code>给我!</p>
            <p>项目地址：<code>https://github.com/c0ny1/upload-labs</code></p>
        </li> -->
	</ol>
</div>


<?php
include 'footer.php'
?>
