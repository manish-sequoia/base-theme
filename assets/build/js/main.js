(()=>{var e={876:()=>{const e={init(){this.primaryMenu()},primaryMenu(){let e,t;const r=document.querySelector(".primary-navigation");if(!r)return!1;const n=r.getElementsByTagName("a");for(e=0,t=n.length;e<t;e++)n[e].addEventListener("focus",a,!0),n[e].addEventListener("blur",a,!0);function a(){let e=this;for(;-1===e.className.indexOf("primary-menu");)"li"===e.tagName.toLowerCase()&&(-1!==e.className.indexOf("focus")?e.className=e.className.replace(" focus",""):e.className+=" focus"),e=e.parentElement}}};window.addEventListener("DOMContentLoaded",(()=>{e.init()}))}},t={};function r(n){var a=t[n];if(void 0!==a)return a.exports;var o=t[n]={exports:{}};return e[n](o,o.exports,r),o.exports}r.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return r.d(t,{a:t}),t},r.d=(e,t)=>{for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{"use strict";r(876)})()})();