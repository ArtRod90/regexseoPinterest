!function(){const t=document.querySelector("#div"),e=document.querySelector("#buscar");let n=document.querySelector("#buscartxt");e.addEventListener("click",(function(e){e.preventDefault(),null==n.value.trim()||""===n.value.trim()?swal.fire({title:"you must write an email",icon:"error"}):async function(e){const n=new FormData;n.append("usuario",e);try{const e="http://localhost:3000/admin/buscar",i=await fetch(e,{method:"POST",body:n}),o=await i.json();swal.fire({title:o.mensaje,icon:o.tipo}),"success"===o.tipo&&(function(){for(;t.firstChild;)t.removeChild(t.firstChild)}(),function(e){let n=document.createElement("div");e.forEach(e=>{let i;i=null===e.imagen||""===e.imagen?'<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="100" height="100" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>':`<img src="${e.imagen}" class="rounded-circle img-fluid img-thumbnail" alt="foto"">`,n.innerHTML=`\n                <div id="div" style="width: 10rem; height: auto;" >\n               ${i}\n              <p>${e.name}</p>\n              <a href="#">${e.email}</a>\n              <button class="btn btn-primary mt-3" data-id="${e.id}">Make editor</button>\n              <button class="btn btn-danger mt-3" data-id="${e.id}">Ban</button>\n             </div>\n             \n                <?php \n             }`,t.appendChild(n)})}(o.usuario))}catch(t){console.log(t),swal.fire({title:"Error",icon:"error",showConfirmButton:!1,timer:2e3})}}(n.value.trim())}))}();