/*
 Highcharts JS v9.3.2 (2021-11-29)

 Client side exporting module

 (c) 2015-2021 Torstein Honsi / Oystein Moseng

 License: www.highcharts.com/license
*/
'use strict';(function(a){"object"===typeof module&&module.exports?(a["default"]=a,module.exports=a):"function"===typeof define&&define.amd?define("highcharts/modules/offline-exporting",["highcharts","highcharts/modules/exporting"],function(e){a(e);a.Highcharts=e;return a}):a("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(a){function e(a,r,b,e){a.hasOwnProperty(r)||(a[r]=e.apply(null,b))}a=a?a._modules:{};e(a,"Extensions/DownloadURL.js",[a["Core/Globals.js"]],function(a){var e=a.isSafari,
    b=a.win,q=b.document,t=b.URL||b.webkitURL||b,n=a.dataURLtoBlob=function(a){if((a=a.replace(/filename=.*;/,"").match(/data:([^;]*)(;base64)?,([0-9A-Za-z+/]+)/))&&3<a.length&&b.atob&&b.ArrayBuffer&&b.Uint8Array&&b.Blob&&t.createObjectURL){var v=b.atob(a[3]),g=new b.ArrayBuffer(v.length);g=new b.Uint8Array(g);for(var k=0;k<g.length;++k)g[k]=v.charCodeAt(k);a=new b.Blob([g],{type:a[1]});return t.createObjectURL(a)}};a=a.downloadURL=function(a,m){var g=b.navigator,k=q.createElement("a");if("string"===
    typeof a||a instanceof String||!g.msSaveOrOpenBlob){a=""+a;g=/Edge\/\d+/.test(g.userAgent);if(e&&"string"===typeof a&&0===a.indexOf("data:application/pdf")||g||2E6<a.length)if(a=n(a)||"",!a)throw Error("Failed to convert to blob");if("undefined"!==typeof k.download)k.href=a,k.download=m,q.body.appendChild(k),k.click(),q.body.removeChild(k);else try{var h=b.open(a,"chart");if("undefined"===typeof h||null===h)throw Error("Failed to open window");}catch(P){b.location.href=a}}else g.msSaveOrOpenBlob(a,
    m)};return{dataURLtoBlob:n,downloadURL:a}});e(a,"Extensions/OfflineExporting/OfflineExportingDefaults.js",[],function(){return{libURL:"https://code.highcharts.com/9.3.2/lib/",menuItemDefinitions:{downloadPNG:{textKey:"downloadPNG",onclick:function(){this.exportChartLocal()}},downloadJPEG:{textKey:"downloadJPEG",onclick:function(){this.exportChartLocal({type:"image/jpeg"})}},downloadSVG:{textKey:"downloadSVG",onclick:function(){this.exportChartLocal({type:"image/svg+xml"})}},downloadPDF:{textKey:"downloadPDF",
            onclick:function(){this.exportChartLocal({type:"application/pdf"})}}}}});e(a,"Extensions/OfflineExporting/OfflineExporting.js",[a["Core/Renderer/HTML/AST.js"],a["Core/Chart/Chart.js"],a["Core/DefaultOptions.js"],a["Extensions/DownloadURL.js"],a["Extensions/Exporting/Exporting.js"],a["Core/Globals.js"],a["Extensions/OfflineExporting/OfflineExportingDefaults.js"],a["Core/Utilities.js"]],function(a,e,b,K,t,n,v,m){var g=b.defaultOptions,k=K.downloadURL,h=n.win,q=n.doc,r=m.addEvent,C=m.error,L=m.extend,
    M=m.fireEvent,D=m.merge;a.allowedAttributes.push("data-z-index","fill-opacity","rx","ry","stroke-dasharray","stroke-linejoin","text-anchor","transform","version","viewBox","visibility","xmlns","xmlns:xlink");a.allowedTags.push("desc","clippath","g");var E=[],u;(function(b){function e(a,f){var c=this,d=D(c.options.exporting,a),w=function(a){!1===d.fallbackToExportServer?d.error?d.error(d,a):C(28,!0):c.exportChart(d)};a=function(){return[].some.call(c.container.getElementsByTagName("image"),function(a){a=
    a.getAttribute("href");return""!==a&&"string"===typeof a&&0!==a.indexOf("data:")})};n.isMS&&c.styledMode&&!t.inlineWhitelist.length&&t.inlineWhitelist.push(/^blockSize/,/^border/,/^caretColor/,/^color/,/^columnRule/,/^columnRuleColor/,/^cssFloat/,/^cursor/,/^fill$/,/^fillOpacity/,/^font/,/^inlineSize/,/^length/,/^lineHeight/,/^opacity/,/^outline/,/^parentRule/,/^rx$/,/^ry$/,/^stroke/,/^textAlign/,/^textAnchor/,/^textDecoration/,/^transform/,/^vectorEffect/,/^visibility/,/^x$/,/^y$/);n.isMS&&("application/pdf"===
    d.type||c.container.getElementsByTagName("image").length&&"image/svg+xml"!==d.type)||"application/pdf"===d.type&&a()?w(Error("Image type not supported for this chart/browser.")):c.getSVGForLocalExport(d,f||{},w,function(a){-1<a.indexOf("<foreignObject")&&"image/svg+xml"!==d.type&&(n.isMS||"application/pdf"===d.type)?w(Error("Image type not supported for charts with embedded HTML")):b.downloadSVGLocal(a,L({filename:c.getFilename()},d),w,function(){return M(c,"exportChartLocalSuccess")})})}function m(a,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            f){var c=q.getElementsByTagName("head")[0],d=q.createElement("script");d.type="text/javascript";d.src=a;d.onload=f;d.onerror=function(){C("Error loading script "+a)};c.appendChild(d)}function u(a,f,l,d){var c=this,h=function(){g&&q===m&&d(c.sanitizeSVG(e.innerHTML,p))},k=function(a,c,d){++q;d.imageElement.setAttributeNS("http://www.w3.org/1999/xlink","href",a);h()},e,p,y=null,g,m=0,q=0;c.unbindGetSVG=r(c,"getSVG",function(a){p=a.chartCopy.options;g=(e=a.chartCopy.container.cloneNode(!0))&&e.getElementsByTagName("image")||
    [];m=g.length});c.getSVGForExport(a,f);try{if(!g||!g.length){d(c.sanitizeSVG(e.innerHTML,p));return}for(f=0;f<g.length;f++){var x=g[f];(y=x.getAttributeNS("http://www.w3.org/1999/xlink","href"))?b.imageToDataUrl(y,"image/png",{imageElement:x},a.scale,k,l,l,l):(q++,x.parentNode.removeChild(x),f--,h())}}catch(A){l(A)}c.unbindGetSVG()}function I(a,f,l,d,g,e,k,m,p){var c=new h.Image,w=function(){setTimeout(function(){var b=q.createElement("canvas"),e=b.getContext&&b.getContext("2d");try{if(e){b.height=
    c.height*d;b.width=c.width*d;e.drawImage(c,0,0,b.width,b.height);try{var h=b.toDataURL(f);g(h,f,l,d)}catch(G){H(a,f,l,d)}}else k(a,f,l,d)}finally{p&&p(a,f,l,d)}},b.loadEventDeferDelay)},F=function(){m(a,f,l,d);p&&p(a,f,l,d)};var H=function(){c=new h.Image;H=e;c.crossOrigin="Anonymous";c.onload=w;c.onerror=F;c.src=a};c.onload=w;c.onerror=F;c.src=a}function B(a){var c=h.navigator.userAgent;c=-1<c.indexOf("WebKit")&&0>c.indexOf("Chrome");try{if(!c&&-1===a.indexOf("<foreignObject"))return b.domurl.createObjectURL(new h.Blob([a],
    {type:"image/svg+xml;charset-utf-16"}))}catch(l){}return"data:image/svg+xml;charset=UTF-8,"+encodeURIComponent(a)}function J(a,b){var c=a.width.baseVal.value+2*b;b=a.height.baseVal.value+2*b;c=new h.jsPDF(b>c?"p":"l","pt",[c,b]);[].forEach.call(a.querySelectorAll('*[visibility="hidden"]'),function(a){a.parentNode.removeChild(a)});b=a.querySelectorAll("linearGradient");for(var d=0;d<b.length;d++)for(var f=b[d].querySelectorAll("stop"),e=0;e<f.length&&"0"===f[e].getAttribute("offset")&&"0"===f[e+1].getAttribute("offset");)f[e].remove(),
    e++;[].forEach.call(a.querySelectorAll("tspan"),function(a){"\u200b"===a.textContent&&(a.textContent=" ",a.setAttribute("dx",-5))});h.svg2pdf(a,c,{removeInvalid:!0});return c.output("datauristring")}b.CanVGRenderer={};b.domurl=h.URL||h.webkitURL||h;b.loadEventDeferDelay=n.isMS?150:0;b.compose=function(a){if(-1===E.indexOf(a)){E.push(a);var b=a.prototype;b.getSVGForLocalExport=u;b.exportChartLocal=e;D(!0,g.exporting,v)}return a};b.downloadSVGLocal=function(c,e,l,d){var f=q.createElement("div"),n=e.type||
    "image/png",r=(e.filename||"chart")+"."+("image/svg+xml"===n?"svg":n.split("/")[1]),t=e.scale||1,p=e.libURL||g.exporting.libURL,y=!0;p="/"!==p.slice(-1)?p+"/":p;var u=function(){a.setElementHTML(f,c);var b=f.getElementsByTagName("text"),e;[].forEach.call(b,function(a){["font-family","font-size"].forEach(function(b){for(var c=a;c&&c!==f;){if(c.style[b]){a.style[b]=c.style[b];break}c=c.parentNode}});a.style["font-family"]=a.style["font-family"]&&a.style["font-family"].split(" ").splice(-1);e=a.getElementsByTagName("title");
    [].forEach.call(e,function(b){a.removeChild(b)})});b=J(f.firstChild,0);try{k(b,r),d&&d()}catch(G){l(G)}};if("image/svg+xml"===n)try{if("undefined"!==typeof h.navigator.msSaveOrOpenBlob){var v=new MSBlobBuilder;v.append(c);var z=v.getBlob("image/svg+xml")}else z=B(c);k(z,r);d&&d()}catch(A){l(A)}else if("application/pdf"===n)h.jsPDF&&h.svg2pdf?u():(y=!0,m(p+"jspdf.js",function(){m(p+"svg2pdf.js",function(){u()})}));else{z=B(c);var x=function(){try{b.domurl.revokeObjectURL(z)}catch(A){}};I(z,n,{},t,
    function(a){try{k(a,r),d&&d()}catch(N){l(N)}},function(){var a=q.createElement("canvas"),b=a.getContext("2d"),e=c.match(/^<svg[^>]*width\s*=\s*"?(\d+)"?[^>]*>/)[1]*t,f=c.match(/^<svg[^>]*height\s*=\s*"?(\d+)"?[^>]*>/)[1]*t,g=function(){h.canvg.Canvg.fromString(b,c).start();try{k(h.navigator.msSaveOrOpenBlob?a.msToBlob():a.toDataURL(n),r),d&&d()}catch(O){l(O)}finally{x()}};a.width=e;a.height=f;h.canvg?g():(y=!0,m(p+"canvg.js",function(){g()}))},l,l,function(){y&&x()})}};b.getScript=m;b.imageToDataUrl=
    I;b.svgToDataUrl=B;b.svgToPdf=J})(u||(u={}));return u});e(a,"masters/modules/offline-exporting.src.js",[a["Core/Globals.js"],a["Extensions/OfflineExporting/OfflineExporting.js"]],function(a,e){a.downloadSVGLocal=e.downloadSVGLocal;e.compose(a.Chart)})});
//# sourceMappingURL=offline-exporting.js.map
