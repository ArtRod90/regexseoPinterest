!function(){let t=0,e=[],n=[],o=[],i=[];!async function(){try{const r="http://localhost:3000/api/carga",s=await fetch(r,{method:"POST"}),c=await s.json();if(e=c.fotos,n=c.usuario,o=c.favoritas,i=c.numerofavoritas,c.fotos.length>20){t=1;const r=document.querySelector("#btntcarga");r.addEventListener("click",(function(s){!function(){for(let r=20*t;r<e.length;r++){const t=e[r];let a,s,c=document.createElement("div"),d=[];for(let e=0;e<o.length;e++){const i=o[e];i.iduser===n.id&&i.idimagenes===t.id&&(a="icon-tabler-fill")}for(let e=0;e<i.length;e++){const n=i[e];n.idimagenes===t.id&&d.push(n)}s=d.length,c.innerHTML=`\n               <div class=" " style="width: 18rem; height: auto;" >\n     <img src="${t.url}" class="foto card-img-top img-fluid img-thumbnail" alt="foto"">\n     <div class="card-body">\n       <h5 class="card-title">${t.Titulo}</h5>\n       <p class="card-text">${t.descripcion}</p>\n       \n     </div>\n     <div class="card-footer">\n     <button data-idimagenes="${t.id}" data-iduser="${n.id}" class="btnFavorito btn btn-outline-light mt-2">\n     \n     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler btnF `+a+'" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">\n     <path stroke="none" d="M0 0h24v24H0z" fill="none"/>\n     <path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />\n   </svg> '+s+"</button>\n     </div>\n   </div>",l.appendChild(c)}}(),a(),setTimeout(()=>{t++,20*t>c.fotos.length&&r.remove()},500)}))}else if(btntcarga.remove(),c.fotos.length<=0){let t=document.createElement("p");t.textContent="There is no image yet",l.appendChild(t)}}catch(t){console.log(t),swal.fire({title:"Error",icon:"error",showConfirmButton:!1,timer:2e3})}}();const l=document.querySelector(".fotosdash");async function r(t){let e=t.iduser,n=t.idimagenes;const o=new FormData;o.append("iduser",e.trim()),o.append("idimagenes",n.trim());try{const t="http://localhost:3000/api/favoritas",e=await fetch(t,{method:"POST",body:o}),n=await e.json();if(n.resultado){return[!0,n.numero]}return void swal.fire({title:n.mensaje,icon:n.tipo})}catch(t){console.log(t),swal.fire({title:"Error",icon:"error",showConfirmButton:!1,timer:2e3})}}async function a(){let e=document.querySelectorAll(".btnFavorito"),n=document.querySelectorAll(".foto");for(let e=20*t;e<n.length;e++){const t=n[e];t.addEventListener("click",(function(e){Swal.fire({imageUrl:t.src,imageAlt:"foto"})}))}for(let n=20*t;n<e.length;n++){let t=e[n];t.addEventListener("click",(function(){resultado=r(t.dataset),resultado.then(e=>{if(e[0]&&t.children[0].classList.toggle("icon-tabler-fill"),"+"===e[1]){let e=parseInt(t.textContent.trim());e++,t.childNodes[2].textContent=" "+e}else{let e=parseInt(t.textContent.trim());e--,t.childNodes[2].textContent=" "+e}})}))}}}();