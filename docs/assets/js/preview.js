var $=function(s,c){return[].slice.call((c||document).querySelectorAll(s))};
addEventListener('scroll',function(){var h=document.documentElement;document.getElementById('pg').style.width=(h.scrollTop/(h.scrollHeight-h.clientHeight)*100)+'%'},{passive:true});
var io=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){e.target.classList.add('on');if(e.target.id=='fg')e.target.classList.add('go');io.unobserve(e.target)}})},{threshold:.15});
$('.rv,#fg').forEach(function(e){io.observe(e)});
var reduceMotion=matchMedia('(prefers-reduced-motion: reduce)').matches;
var co=new IntersectionObserver(function(es){es.forEach(function(e){if(!e.isIntersecting)return;var el=e.target,n=+el.dataset.n;el.setAttribute('aria-label',n);if(reduceMotion){el.textContent=n;co.unobserve(el);return}var start=performance.now(),duration=1500;function tick(now){var progress=Math.min((now-start)/duration,1),ease=1-Math.pow(1-progress,3);el.textContent=Math.round(n*ease);if(progress<1)requestAnimationFrame(tick)}requestAnimationFrame(tick);co.unobserve(el)})},{threshold:.35});
$('[data-n]').forEach(function(e){co.observe(e)});
$('.tb').forEach(function(b){b.onclick=function(){$('.tb').forEach(function(x){x.setAttribute('aria-selected',x==b)});$('.tp').forEach(function(p){p.classList.toggle('on',p.id==b.getAttribute('aria-controls'))})};b.onkeydown=function(e){if(e.key!=='ArrowRight'&&e.key!=='ArrowDown'&&e.key!=='ArrowLeft'&&e.key!=='ArrowUp')return;e.preventDefault();var i=$('.tb').indexOf(b),next=(i+(e.key==='ArrowRight'||e.key==='ArrowDown'?1:-1)+$('.tb').length)%$('.tb').length;$('.tb')[next].focus();$('.tb')[next].click()}});
var tr=document.getElementById('tr'),sl=$('blockquote',tr),dt=document.getElementById('dt');
sl.forEach(function(){dt.appendChild(document.createElement('i'))});
function cur(){var w=sl[0].offsetWidth+18;return Math.min(sl.length-1,Math.round(tr.scrollLeft/w))}
function upd(){var c=cur();$('i',dt).forEach(function(d,i){d.classList.toggle('on',i==c)})}
function go(d){var w=sl[0].offsetWidth+18,n=cur()+d;if(n<0)n=sl.length-1;if(n>=sl.length)n=0;tr.scrollTo({left:n*w,behavior:'smooth'})}
tr.addEventListener('scroll',upd,{passive:true});upd();
document.getElementById('pv').onclick=function(){go(-1)};document.getElementById('nx').onclick=function(){go(1)};
$('.chip').forEach(function(c){c.onclick=function(){$('.chip').forEach(function(x){x.setAttribute('aria-pressed',x==c)});$('.plan').forEach(function(p){p.hidden=c.dataset.f!='all'&&p.dataset.c!=c.dataset.f})}});
$('details').forEach(function(d){d.addEventListener('toggle',function(){if(!d.open)return;$('details').forEach(function(other){if(other!==d)other.open=false})})});
$('form.f').forEach(function(f){f.addEventListener('submit',function(ev){ev.preventDefault();var d=new FormData(f);location.href='mailto:biomechanik.wimmersberger@gmail.com?subject='+encodeURIComponent('Gratis-Coaching Anfrage')+'&body='+encodeURIComponent(d.get('m')+'\n\n'+d.get('n')+' ('+d.get('e')+')')})});
