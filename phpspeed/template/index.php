<div id="readme" class="readme boxed-group clearfix announce instapaper_body md">
    <h3>
        <svg aria-hidden="true" class="octicon octicon-book" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path d="M2 5h4v1H2v-1z m0 3h4v-1H2v1z m0 2h4v-1H2v1z m11-5H9v1h4v-1z m0 2H9v1h4v-1z m0 2H9v1h4v-1z m2-6v9c0 0.55-0.45 1-1 1H8.5l-1 1-1-1H1c-0.55 0-1-0.45-1-1V3c0-0.55 0.45-1 1-1h5.5l1 1 1-1h5.5c0.55 0 1 0.45 1 1z m-8 0.5l-0.5-0.5H1v9h6V3.5z m7-0.5H8.5l-0.5 0.5v8.5h6V3z"></path></svg>
        README.md
    </h3>

    <article class="markdown-body entry-content" itemprop="text"><h2><a id="user-content-phpspeed-framework-alpha-version-10" class="anchor" href="#phpspeed-framework-alpha-version-10" aria-hidden="true"><svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path d="M4 9h1v1h-1c-1.5 0-3-1.69-3-3.5s1.55-3.5 3-3.5h4c1.45 0 3 1.69 3 3.5 0 1.41-0.91 2.72-2 3.25v-1.16c0.58-0.45 1-1.27 1-2.09 0-1.28-1.02-2.5-2-2.5H4c-0.98 0-2 1.22-2 2.5s1 2.5 2 2.5z m9-3h-1v1h1c1 0 2 1.22 2 2.5s-1.02 2.5-2 2.5H9c-0.98 0-2-1.22-2-2.5 0-0.83 0.42-1.64 1-2.09v-1.16c-1.09 0.53-2 1.84-2 3.25 0 1.81 1.55 3.5 3 3.5h4c1.45 0 3-1.69 3-3.5s-1.5-3.5-3-3.5z"></path></svg></a>phpspeed framework Alpha version 1.0</h2>

        <div class="highlight highlight-text-html-php"><pre><span class="pl-s1">    <span class="pl-c1">nginx</span> <span class="pl-c1">rewrite</span>: <span class="pl-c1">rewrite</span> <span class="pl-k">^</span>(<span class="pl-k">.</span><span class="pl-k">*</span>)$ <span class="pl-k">/</span><span class="pl-c1">index</span><span class="pl-k">.</span><span class="pl-c1">php</span><span class="pl-k">/</span>$<span class="pl-c1">1</span> <span class="pl-c1">last</span>; <span class="pl-c">#pathinfo</span></span>
<span class="pl-s1">    <span class="pl-en">PHP</span>: <span class="pl-c1">5.5</span><span class="pl-k">.</span><span class="pl-c1">x</span></span></pre></div>

        <h2><a id="user-content-目录结构" class="anchor" href="#目录结构" aria-hidden="true"><svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path d="M4 9h1v1h-1c-1.5 0-3-1.69-3-3.5s1.55-3.5 3-3.5h4c1.45 0 3 1.69 3 3.5 0 1.41-0.91 2.72-2 3.25v-1.16c0.58-0.45 1-1.27 1-2.09 0-1.28-1.02-2.5-2-2.5H4c-0.98 0-2 1.22-2 2.5s1 2.5 2 2.5z m9-3h-1v1h1c1 0 2 1.22 2 2.5s-1.02 2.5-2 2.5H9c-0.98 0-2-1.22-2-2.5 0-0.83 0.42-1.64 1-2.09v-1.16c-1.09 0.53-2 1.84-2 3.25 0 1.81 1.55 3.5 3 3.5h4c1.45 0 3-1.69 3-3.5s-1.5-3.5-3-3.5z"></path></svg></a>目录结构</h2>

        <div class="highlight highlight-text-html-php"><pre><span class="pl-s1"><span class="pl-k">/</span><span class="pl-c1">phpspeed</span><span class="pl-k">/</span>                  <span class="pl-c"># 框架入口</span></span>
<span class="pl-s1">         <span class="pl-c1">config</span><span class="pl-k">/</span>            <span class="pl-c"># 配置文件</span></span>
<span class="pl-s1">         <span class="pl-c1">controller</span><span class="pl-k">/</span>        <span class="pl-c"># 控制器目录</span></span>
<span class="pl-s1">         <span class="pl-c1">extend</span><span class="pl-k">/</span>            <span class="pl-c"># 扩展目录</span></span>
<span class="pl-s1">         <span class="pl-k">function</span><span class="pl-k">/</span><span class="pl-c1">func</span><span class="pl-k">.</span><span class="pl-c1">php</span>  <span class="pl-c"># 函数库</span></span>
<span class="pl-s1">         <span class="pl-c1">library</span><span class="pl-k">/</span>           <span class="pl-c"># 核心目录</span></span>
<span class="pl-s1">         <span class="pl-c1">module</span><span class="pl-k">/</span>            <span class="pl-c"># 模型</span></span>
<span class="pl-s1">         <span class="pl-c1">runtime</span><span class="pl-k">/</span>           <span class="pl-c"># 编译缓存与日志目录</span></span>
<span class="pl-s1">         <span class="pl-c1">template</span><span class="pl-k">/</span>          <span class="pl-c"># 模板目录</span></span>
<span class="pl-s1"><span class="pl-k">/</span><span class="pl-k">public</span><span class="pl-k">/</span>                     <span class="pl-c"># 网站根目录 index.php images js css uploads</span></span>
<span class="pl-s1"></span></pre></div>

        <h2><a id="user-content-路由配置" class="anchor" href="#路由配置" aria-hidden="true"><svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path d="M4 9h1v1h-1c-1.5 0-3-1.69-3-3.5s1.55-3.5 3-3.5h4c1.45 0 3 1.69 3 3.5 0 1.41-0.91 2.72-2 3.25v-1.16c0.58-0.45 1-1.27 1-2.09 0-1.28-1.02-2.5-2-2.5H4c-0.98 0-2 1.22-2 2.5s1 2.5 2 2.5z m9-3h-1v1h1c1 0 2 1.22 2 2.5s-1.02 2.5-2 2.5H9c-0.98 0-2-1.22-2-2.5 0-0.83 0.42-1.64 1-2.09v-1.16c-1.09 0.53-2 1.84-2 3.25 0 1.81 1.55 3.5 3 3.5h4c1.45 0 3-1.69 3-3.5s-1.5-3.5-3-3.5z"></path></svg></a>路由配置</h2>

        <div class="highlight highlight-text-html-php"><pre><span class="pl-s1"><span class="pl-k">return</span> [</span>
<span class="pl-s1">    <span class="pl-c">// 直接返回模板</span></span>
<span class="pl-s1">    <span class="pl-s"><span class="pl-pds">'</span>/<span class="pl-pds">'</span></span> <span class="pl-k">=&gt;</span> <span class="pl-k">function</span>(){<span class="pl-k">return</span> <span class="pl-s"><span class="pl-pds">'</span>index<span class="pl-pds">'</span></span>;},</span>
<span class="pl-s1">    <span class="pl-s"><span class="pl-pds">'</span>/home/user/info<span class="pl-pds">'</span></span> <span class="pl-k">=&gt;</span> <span class="pl-k">function</span>(){</span>
<span class="pl-s1">        <span class="pl-k">return</span> [</span>
<span class="pl-s1">            <span class="pl-s"><span class="pl-pds">'</span>info<span class="pl-pds">'</span></span>,[<span class="pl-s"><span class="pl-pds">'</span>username<span class="pl-pds">'</span></span> <span class="pl-k">=&gt;</span> <span class="pl-s"><span class="pl-pds">'</span>bruce<span class="pl-pds">'</span></span>]</span>
<span class="pl-s1">        ];</span>
<span class="pl-s1">    },</span>
<span class="pl-s1"></span>
<span class="pl-s1">    <span class="pl-c">// 基本路由配置</span></span>
<span class="pl-s1">    <span class="pl-s"><span class="pl-pds">'</span>/home/user/.*<span class="pl-pds">'</span></span>    <span class="pl-k">=&gt;</span> <span class="pl-s"><span class="pl-pds">'</span>home/user<span class="pl-pds">'</span></span>,</span>
<span class="pl-s1">    <span class="pl-s"><span class="pl-pds">'</span>/home/item/.*<span class="pl-pds">'</span></span>    <span class="pl-k">=&gt;</span> <span class="pl-s"><span class="pl-pds">'</span>home/item<span class="pl-pds">'</span></span>,</span>
<span class="pl-s1">    <span class="pl-s"><span class="pl-pds">'</span>/home/list/index<span class="pl-pds">'</span></span> <span class="pl-k">=&gt;</span> <span class="pl-s"><span class="pl-pds">'</span>home/list/index<span class="pl-pds">'</span></span>,</span>
<span class="pl-s1">    <span class="pl-s"><span class="pl-pds">'</span>/test<span class="pl-pds">'</span></span>            <span class="pl-k">=&gt;</span> <span class="pl-s"><span class="pl-pds">'</span>test<span class="pl-pds">'</span></span>,    <span class="pl-c">// 解析到 controller 下test文件</span></span>
<span class="pl-s1">];</span></pre></div>

        <h2><a id="user-content-加载子模板" class="anchor" href="#加载子模板" aria-hidden="true"><svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path d="M4 9h1v1h-1c-1.5 0-3-1.69-3-3.5s1.55-3.5 3-3.5h4c1.45 0 3 1.69 3 3.5 0 1.41-0.91 2.72-2 3.25v-1.16c0.58-0.45 1-1.27 1-2.09 0-1.28-1.02-2.5-2-2.5H4c-0.98 0-2 1.22-2 2.5s1 2.5 2 2.5z m9-3h-1v1h1c1 0 2 1.22 2 2.5s-1.02 2.5-2 2.5H9c-0.98 0-2-1.22-2-2.5 0-0.83 0.42-1.64 1-2.09v-1.16c-1.09 0.53-2 1.84-2 3.25 0 1.81 1.55 3.5 3 3.5h4c1.45 0 3-1.69 3-3.5s-1.5-3.5-3-3.5z"></path></svg></a>加载子模板</h2>

        <div class="highlight highlight-text-html-php"><pre><span class="pl-s1"><span class="pl-k">@</span><span class="pl-k">include</span>(<span class="pl-s"><span class="pl-pds">'</span>public/header<span class="pl-pds">'</span></span>)</span>
<span class="pl-s1"><span class="pl-k">@</span><span class="pl-k">include</span>(<span class="pl-s"><span class="pl-pds">"</span>public/header<span class="pl-pds">"</span></span>)</span></pre></div>

        <h2><a id="user-content-foreach-结构" class="anchor" href="#foreach-结构" aria-hidden="true"><svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path d="M4 9h1v1h-1c-1.5 0-3-1.69-3-3.5s1.55-3.5 3-3.5h4c1.45 0 3 1.69 3 3.5 0 1.41-0.91 2.72-2 3.25v-1.16c0.58-0.45 1-1.27 1-2.09 0-1.28-1.02-2.5-2-2.5H4c-0.98 0-2 1.22-2 2.5s1 2.5 2 2.5z m9-3h-1v1h1c1 0 2 1.22 2 2.5s-1.02 2.5-2 2.5H9c-0.98 0-2-1.22-2-2.5 0-0.83 0.42-1.64 1-2.09v-1.16c-1.09 0.53-2 1.84-2 3.25 0 1.81 1.55 3.5 3 3.5h4c1.45 0 3-1.69 3-3.5s-1.5-3.5-3-3.5z"></path></svg></a>foreach 结构</h2>

        <div class="highlight highlight-text-html-php"><pre><span class="pl-s1"><span class="pl-k">@</span><span class="pl-k">foreach</span>(<span class="pl-smi">$data</span> <span class="pl-k">as</span> <span class="pl-smi">$k</span> <span class="pl-k">=&gt;</span> <span class="pl-smi">$v</span>)</span>
<span class="pl-s1"><span class="pl-k">&lt;</span><span class="pl-c1">p</span><span class="pl-k">&gt;&lt;</span>{<span class="pl-smi">$v</span>}<span class="pl-k">&gt;&lt;</span><span class="pl-k">/</span><span class="pl-c1">p</span><span class="pl-k">&gt;</span></span>
<span class="pl-s1"><span class="pl-k">@</span><span class="pl-c1">end</span></span></pre></div>

        <h2><a id="user-content-if-结构" class="anchor" href="#if-结构" aria-hidden="true"><svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path d="M4 9h1v1h-1c-1.5 0-3-1.69-3-3.5s1.55-3.5 3-3.5h4c1.45 0 3 1.69 3 3.5 0 1.41-0.91 2.72-2 3.25v-1.16c0.58-0.45 1-1.27 1-2.09 0-1.28-1.02-2.5-2-2.5H4c-0.98 0-2 1.22-2 2.5s1 2.5 2 2.5z m9-3h-1v1h1c1 0 2 1.22 2 2.5s-1.02 2.5-2 2.5H9c-0.98 0-2-1.22-2-2.5 0-0.83 0.42-1.64 1-2.09v-1.16c-1.09 0.53-2 1.84-2 3.25 0 1.81 1.55 3.5 3 3.5h4c1.45 0 3-1.69 3-3.5s-1.5-3.5-3-3.5z"></path></svg></a>if 结构</h2>

        <div class="highlight highlight-text-html-php"><pre><span class="pl-s1"><span class="pl-k">@</span><span class="pl-k">if</span>(<span class="pl-c1">1</span>)</span>
<span class="pl-s1"><span class="pl-k">&lt;</span><span class="pl-c1">p</span><span class="pl-k">&gt;</span><span class="pl-c1">9527</span><span class="pl-k">&lt;</span><span class="pl-k">/</span><span class="pl-c1">p</span><span class="pl-k">&gt;</span></span>
<span class="pl-s1"><span class="pl-k">@</span><span class="pl-k">elseif</span>(<span class="pl-c1">1</span>)</span>
<span class="pl-s1"><span class="pl-k">&lt;</span><span class="pl-c1">p</span><span class="pl-k">&gt;</span><span class="pl-c1">9527</span><span class="pl-k">&lt;</span><span class="pl-k">/</span><span class="pl-c1">p</span><span class="pl-k">&gt;</span></span>
<span class="pl-s1"><span class="pl-k">@</span><span class="pl-c1">end</span></span></pre></div>

        <h2><a id="user-content-switch-结构" class="anchor" href="#switch-结构" aria-hidden="true"><svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path d="M4 9h1v1h-1c-1.5 0-3-1.69-3-3.5s1.55-3.5 3-3.5h4c1.45 0 3 1.69 3 3.5 0 1.41-0.91 2.72-2 3.25v-1.16c0.58-0.45 1-1.27 1-2.09 0-1.28-1.02-2.5-2-2.5H4c-0.98 0-2 1.22-2 2.5s1 2.5 2 2.5z m9-3h-1v1h1c1 0 2 1.22 2 2.5s-1.02 2.5-2 2.5H9c-0.98 0-2-1.22-2-2.5 0-0.83 0.42-1.64 1-2.09v-1.16c-1.09 0.53-2 1.84-2 3.25 0 1.81 1.55 3.5 3 3.5h4c1.45 0 3-1.69 3-3.5s-1.5-3.5-3-3.5z"></path></svg></a>switch 结构</h2>

        <div class="highlight highlight-text-html-php"><pre><span class="pl-s1"><span class="pl-k">@</span><span class="pl-k">switch</span>(<span class="pl-smi">$aa</span>)</span>
<span class="pl-s1"><span class="pl-k">@</span><span class="pl-k">case</span> <span class="pl-s"><span class="pl-pds">'</span>1<span class="pl-pds">'</span></span> : <span class="pl-k">&lt;</span><span class="pl-c1">p</span><span class="pl-k">&gt;</span><span class="pl-c1">9527</span><span class="pl-k">&lt;</span><span class="pl-k">/</span><span class="pl-c1">p</span><span class="pl-k">&gt;</span> <span class="pl-k">@</span><span class="pl-k">break</span></span>
<span class="pl-s1"><span class="pl-k">@</span><span class="pl-k">case</span> <span class="pl-s"><span class="pl-pds">'</span>2<span class="pl-pds">'</span></span> : <span class="pl-k">&lt;</span><span class="pl-c1">p</span><span class="pl-k">&gt;</span><span class="pl-c1">9527</span><span class="pl-k">&lt;</span><span class="pl-k">/</span><span class="pl-c1">p</span><span class="pl-k">&gt;</span> <span class="pl-k">@</span><span class="pl-k">break</span></span>
<span class="pl-s1"><span class="pl-k">@</span><span class="pl-k">default</span>  : <span class="pl-k">&lt;</span><span class="pl-c1">p</span><span class="pl-k">&gt;</span><span class="pl-c1">9527</span><span class="pl-k">&lt;</span><span class="pl-k">/</span><span class="pl-c1">p</span><span class="pl-k">&gt;</span></span>
<span class="pl-s1"><span class="pl-k">@</span><span class="pl-c1">end</span></span></pre></div>

        <h2><a id="user-content-for-结构" class="anchor" href="#for-结构" aria-hidden="true"><svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path d="M4 9h1v1h-1c-1.5 0-3-1.69-3-3.5s1.55-3.5 3-3.5h4c1.45 0 3 1.69 3 3.5 0 1.41-0.91 2.72-2 3.25v-1.16c0.58-0.45 1-1.27 1-2.09 0-1.28-1.02-2.5-2-2.5H4c-0.98 0-2 1.22-2 2.5s1 2.5 2 2.5z m9-3h-1v1h1c1 0 2 1.22 2 2.5s-1.02 2.5-2 2.5H9c-0.98 0-2-1.22-2-2.5 0-0.83 0.42-1.64 1-2.09v-1.16c-1.09 0.53-2 1.84-2 3.25 0 1.81 1.55 3.5 3 3.5h4c1.45 0 3-1.69 3-3.5s-1.5-3.5-3-3.5z"></path></svg></a>for 结构</h2>

        <div class="highlight highlight-text-html-php"><pre><span class="pl-s1"><span class="pl-k">@</span><span class="pl-k">for</span>(<span class="pl-smi">$i</span><span class="pl-k">=</span><span class="pl-c1">0</span>;<span class="pl-smi">$i</span><span class="pl-k">&lt;</span><span class="pl-c1">10</span>;<span class="pl-smi">$i</span><span class="pl-k">++</span>)</span>
<span class="pl-s1"><span class="pl-k">&lt;</span><span class="pl-c1">p</span><span class="pl-k">&gt;&lt;</span>{<span class="pl-smi">$i</span>}<span class="pl-k">&gt;&lt;</span><span class="pl-k">/</span><span class="pl-c1">p</span><span class="pl-k">&gt;</span></span>
<span class="pl-s1"><span class="pl-k">@</span><span class="pl-c1">end</span></span></pre></div>

        <h2><a id="user-content-定义变量" class="anchor" href="#定义变量" aria-hidden="true"><svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path d="M4 9h1v1h-1c-1.5 0-3-1.69-3-3.5s1.55-3.5 3-3.5h4c1.45 0 3 1.69 3 3.5 0 1.41-0.91 2.72-2 3.25v-1.16c0.58-0.45 1-1.27 1-2.09 0-1.28-1.02-2.5-2-2.5H4c-0.98 0-2 1.22-2 2.5s1 2.5 2 2.5z m9-3h-1v1h1c1 0 2 1.22 2 2.5s-1.02 2.5-2 2.5H9c-0.98 0-2-1.22-2-2.5 0-0.83 0.42-1.64 1-2.09v-1.16c-1.09 0.53-2 1.84-2 3.25 0 1.81 1.55 3.5 3 3.5h4c1.45 0 3-1.69 3-3.5s-1.5-3.5-3-3.5z"></path></svg></a>定义变量</h2>

        <div class="highlight highlight-text-html-php"><pre><span class="pl-s1">{<span class="pl-k">@</span><span class="pl-c1">aa</span><span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">'</span>1<span class="pl-pds">'</span></span>}</span>
<span class="pl-s1">{<span class="pl-k">@</span><span class="pl-c1">aa</span><span class="pl-k">=</span>[<span class="pl-s"><span class="pl-pds">'</span>45<span class="pl-pds">'</span></span>,<span class="pl-s"><span class="pl-pds">'</span>321<span class="pl-pds">'</span></span>,<span class="pl-s"><span class="pl-pds">'</span>13<span class="pl-pds">'</span></span>]}</span></pre></div>

        <h2><a id="user-content-直接使用函数" class="anchor" href="#直接使用函数" aria-hidden="true"><svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path d="M4 9h1v1h-1c-1.5 0-3-1.69-3-3.5s1.55-3.5 3-3.5h4c1.45 0 3 1.69 3 3.5 0 1.41-0.91 2.72-2 3.25v-1.16c0.58-0.45 1-1.27 1-2.09 0-1.28-1.02-2.5-2-2.5H4c-0.98 0-2 1.22-2 2.5s1 2.5 2 2.5z m9-3h-1v1h1c1 0 2 1.22 2 2.5s-1.02 2.5-2 2.5H9c-0.98 0-2-1.22-2-2.5 0-0.83 0.42-1.64 1-2.09v-1.16c-1.09 0.53-2 1.84-2 3.25 0 1.81 1.55 3.5 3 3.5h4c1.45 0 3-1.69 3-3.5s-1.5-3.5-3-3.5z"></path></svg></a>直接使用函数</h2>

        <div class="highlight highlight-text-html-php"><pre><span class="pl-s1">{:<span class="pl-c1">extract</span>(<span class="pl-smi">$aa</span>)}</span></pre></div>

        <h2><a id="user-content-输出" class="anchor" href="#输出" aria-hidden="true"><svg aria-hidden="true" class="octicon octicon-link" height="16" version="1.1" viewBox="0 0 16 16" width="16"><path d="M4 9h1v1h-1c-1.5 0-3-1.69-3-3.5s1.55-3.5 3-3.5h4c1.45 0 3 1.69 3 3.5 0 1.41-0.91 2.72-2 3.25v-1.16c0.58-0.45 1-1.27 1-2.09 0-1.28-1.02-2.5-2-2.5H4c-0.98 0-2 1.22-2 2.5s1 2.5 2 2.5z m9-3h-1v1h1c1 0 2 1.22 2 2.5s-1.02 2.5-2 2.5H9c-0.98 0-2-1.22-2-2.5 0-0.83 0.42-1.64 1-2.09v-1.16c-1.09 0.53-2 1.84-2 3.25 0 1.81 1.55 3.5 3 3.5h4c1.45 0 3-1.69 3-3.5s-1.5-3.5-3-3.5z"></path></svg></a>输出</h2>

        <div class="highlight highlight-text-html-php"><pre><span class="pl-s1"><span class="pl-k">&lt;</span><span class="pl-c1">p</span><span class="pl-k">&gt;&lt;</span>{<span class="pl-smi">$aa</span>}<span class="pl-k">&gt;&lt;</span><span class="pl-k">/</span><span class="pl-c1">p</span><span class="pl-k">&gt;</span></span>
<span class="pl-s1"><span class="pl-k">&lt;</span>{<span class="pl-c1">date</span>(<span class="pl-s"><span class="pl-pds">'</span>Y-m-d<span class="pl-pds">'</span></span>,<span class="pl-c1">time</span>())}<span class="pl-k">&gt;</span></span>
<span class="pl-s1"><span class="pl-k">&lt;</span>{<span class="pl-smi">$check</span> ? <span class="pl-s"><span class="pl-pds">'</span>true<span class="pl-pds">'</span></span> : <span class="pl-s"><span class="pl-pds">'</span>false<span class="pl-pds">'</span></span>}<span class="pl-k">&gt;</span></span></pre></div>
    </article>
</div>