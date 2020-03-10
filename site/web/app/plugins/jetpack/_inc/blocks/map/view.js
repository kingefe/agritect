!function(e,t){for(var n in t)e[n]=t[n]}(window,function(e){function t(t){for(var n,r,a=t[0],i=t[1],l=0,c=[];l<a.length;l++)r=a[l],o[r]&&c.push(o[r][0]),o[r]=0;for(n in i)Object.prototype.hasOwnProperty.call(i,n)&&(e[n]=i[n]);for(s&&s(t);c.length;)c.shift()()}var n={},r={6:0},o={6:0};function a(t){if(n[t])return n[t].exports;var r=n[t]={i:t,l:!1,exports:{}};return e[t].call(r.exports,r,r.exports,a),r.l=!0,r.exports}a.e=function(e){var t=[];r[e]?t.push(r[e]):0!==r[e]&&{11:1}[e]&&t.push(r[e]=new Promise(function(t,n){for(var r="rtl"===document.dir?({11:"vendors~map/mapbox-gl"}[e]||e)+"."+{11:"7c4bcf5e0fd9f38f3739"}[e]+".rtl.css":({11:"vendors~map/mapbox-gl"}[e]||e)+"."+{11:"7c4bcf5e0fd9f38f3739"}[e]+".css",o=a.p+r,i=document.getElementsByTagName("link"),l=0;l<i.length;l++){var c=(u=i[l]).getAttribute("data-href")||u.getAttribute("href");if("stylesheet"===u.rel&&(c===r||c===o))return t()}var s=document.getElementsByTagName("style");for(l=0;l<s.length;l++){var u;if((c=(u=s[l]).getAttribute("data-href"))===r||c===o)return t()}var p=document.createElement("link");p.rel="stylesheet",p.type="text/css",p.setAttribute("data-webpack",!0),p.onload=t,p.onerror=function(t){var r=t&&t.target&&t.target.src||o,a=new Error("Loading CSS chunk "+e+" failed.\n("+r+")");a.request=r,n(a)},p.href=o,document.getElementsByTagName("head")[0].appendChild(p)}).then(function(){r[e]=0}));var n=o[e];if(0!==n)if(n)t.push(n[2]);else{var i=new Promise(function(t,r){n=o[e]=[t,r]});t.push(n[2]=i);var l,c=document.createElement("script");c.charset="utf-8",c.timeout=120,a.nc&&c.setAttribute("nonce",a.nc),c.src=function(e){return a.p+""+({11:"vendors~map/mapbox-gl"}[e]||e)+"."+{11:"7c4bcf5e0fd9f38f3739"}[e]+".js"}(e);var s=new Error;l=function(t){c.onerror=c.onload=null,clearTimeout(u);var n=o[e];if(0!==n){if(n){var r=t&&("load"===t.type?"missing":t.type),a=t&&t.target&&t.target.src;s.message="Loading chunk "+e+" failed.\n("+r+": "+a+")",s.name="ChunkLoadError",s.type=r,s.request=a,n[1](s)}o[e]=void 0}};var u=setTimeout(function(){l({type:"timeout",target:c})},12e4);c.onerror=c.onload=l,document.head.appendChild(c)}return Promise.all(t)},a.m=e,a.c=n,a.d=function(e,t,n){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)a.d(n,r,function(t){return e[t]}.bind(null,r));return n},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="",a.oe=function(e){throw console.error(e),e};var i=window.webpackJsonp=window.webpackJsonp||[],l=i.push.bind(i);i.push=t,i=i.slice();for(var c=0;c<i.length;c++)t(i[c]);var s=l;return a(a.s=268)}({0:function(e,t){e.exports=wp.element},1:function(e,t){e.exports=wp.i18n},10:function(e,t,n){var r=n(76);e.exports=function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&r(e,t)}},11:function(e,t){function n(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}e.exports=function(e,t,r){return t&&n(e.prototype,t),r&&n(e,r),e}},2:function(e,t){e.exports=wp.components},20:function(e,t,n){var r=n(70),o=n(71),a=n(72);e.exports=function(e){return r(e)||o(e)||a()}},21:function(e,t,n){var r=n(52),o=n(53),a=n(54);e.exports=function(e,t){return r(e)||o(e,t)||a()}},24:function(e,t,n){"use strict";n.d(t,"a",function(){return a});var r=n(0),o=n(1),a={name:"map",prefix:"jetpack",title:Object(o.__)("Map","jetpack"),icon:Object(r.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",viewBox:"0 0 24 24",role:"img","aria-hidden":"true",focusable:"false"},Object(r.createElement)("path",{fill:"none",d:"M0 0h24v24H0V0z"}),Object(r.createElement)("path",{d:"M20.5 3l-.16.03L15 5.1 9 3 3.36 4.9c-.21.07-.36.25-.36.48V20.5c0 .28.22.5.5.5l.16-.03L9 18.9l6 2.1 5.64-1.9c.21-.07.36-.25.36-.48V3.5c0-.28-.22-.5-.5-.5zM10 5.47l4 1.4v11.66l-4-1.4V5.47zm-5 .99l3-1.01v11.7l-3 1.16V6.46zm14 11.08l-3 1.01V6.86l3-1.16v11.84z"})),category:"jetpack",keywords:[Object(o._x)("map","block search term","jetpack"),Object(o._x)("location","block search term","jetpack"),Object(o._x)("navigation","block search term","jetpack")],description:Object(o.__)("Add an interactive map showing one or more locations.","jetpack"),attributes:{align:{type:"string"},points:{type:"array",default:[]},mapStyle:{type:"string",default:"default"},mapDetails:{type:"boolean",default:!0},zoom:{type:"integer",default:13},mapCenter:{type:"object",default:{longitude:-122.41941550000001,latitude:37.7749295}},markerColor:{type:"string",default:"red"}},supports:{html:!1},mapStyleOptions:[{value:"default",label:Object(o.__)("Basic","jetpack")},{value:"black_and_white",label:Object(o.__)("Black and white","jetpack")},{value:"satellite",label:Object(o.__)("Satellite","jetpack")},{value:"terrain",label:Object(o.__)("Terrain","jetpack")}],validAlignments:["center","wide","full"],markerIcon:Object(r.createElement)("svg",{width:"14",height:"20",viewBox:"0 0 14 20",xmlns:"http://www.w3.org/2000/svg"},Object(r.createElement)("g",{id:"Page-1",fill:"none",fillRule:"evenodd"},Object(r.createElement)("g",{id:"outline-add_location-24px",transform:"translate(-5 -2)"},Object(r.createElement)("polygon",{id:"Shape",points:"0 0 24 0 24 24 0 24"}),Object(r.createElement)("path",{d:"M12,2 C8.14,2 5,5.14 5,9 C5,14.25 12,22 12,22 C12,22 19,14.25 19,9 C19,5.14 15.86,2 12,2 Z M7,9 C7,6.24 9.24,4 12,4 C14.76,4 17,6.24 17,9 C17,11.88 14.12,16.19 12,18.88 C9.92,16.21 7,11.85 7,9 Z M13,6 L11,6 L11,8 L9,8 L9,10 L11,10 L11,12 L13,12 L13,10 L15,10 L15,8 L13,8 L13,6 Z",id:"Shape",fill:"#000",fillRule:"nonzero"}))))}},268:function(e,t,n){n(36),e.exports=n(282)},27:function(e,t,n){"object"==typeof window&&window.Jetpack_Block_Assets_Base_Url&&(n.p=window.Jetpack_Block_Assets_Base_Url)},282:function(e,t,n){"use strict";n.r(t);var r=n(3),o=n.n(r),a=(n(83),n(63)),i=n(24),l=n(20),c=n.n(l),s=n(7),u=n.n(s),p=n(11),f=n.n(p),d=n(5),m=n(0),b=function(){function e(){u()(this,e)}return f()(e,[{key:"blockIterator",value:function(e,t){var n=this;t.forEach(function(t){n.initializeFrontendReactBlocks(t.component,t.options,e)})}},{key:"initializeFrontendReactBlocks",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=arguments.length>2?arguments[2]:void 0,r=t.settings,o=r.attributes,a=r.name,i=r.prefix,l=t.selector,c=i&&i.length?"".concat(i,"/").concat(a):a,s=".wp-block-".concat(c.replace("/","-")),u=n.querySelectorAll(s),p=!0,f=!1,b=void 0;try{for(var h,v=u[Symbol.iterator]();!(p=(h=v.next()).done);p=!0){var y=h.value,g=this.extractAttributesFromContainer(y,o);Object(d.assign)(g,t.props);var k=this.extractChildrenFromContainer(y),w=Object(m.createElement)(e,g,k);Object(m.render)(w,l?y.querySelector(l):y)}}catch(j){f=!0,b=j}finally{try{p||null==v.return||v.return()}finally{if(f)throw b}}}},{key:"extractAttributesFromContainer",value:function(e,t){var n={};for(var r in t){var o=t[r],a="data-"+Object(d.kebabCase)(r);if(n[r]=e.getAttribute(a),"boolean"===o.type&&(n[r]="false"!==n[r]&&!!n[r]),"array"===o.type||"object"===o.type)try{n[r]=JSON.parse(n[r])}catch(i){n[r]=null}}return n}},{key:"extractChildrenFromContainer",value:function(e){return c()(e.childNodes).map(function(e){for(var t={},n=0;n<e.attributes.length;n++){var r=e.attributes[n];t[r.nodeName]=r.nodeValue}return t.dangerouslySetInnerHTML={__html:e.innerHTML},Object(m.createElement)(e.tagName.toLowerCase(),t)})}}]),e}();function h(e,t){var n=Object.keys(e);return Object.getOwnPropertySymbols&&n.push.apply(n,Object.getOwnPropertySymbols(e)),t&&(n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),n}function v(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?h(n,!0).forEach(function(t){o()(e,t,n[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):h(n).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))})}return e}"undefined"!=typeof window&&window.addEventListener("load",function(){(new b).blockIterator(document,[{component:a.a,options:{settings:v({},i.a,{attributes:v({},i.a.attributes,{apiKey:{type:"string",default:""}})})}}])})},3:function(e,t){e.exports=function(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}},36:function(e,t,n){"use strict";n.r(t);n(27)},4:function(e,t){e.exports=function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}},5:function(e,t){e.exports=lodash},52:function(e,t){e.exports=function(e){if(Array.isArray(e))return e}},53:function(e,t){e.exports=function(e,t){var n=[],r=!0,o=!1,a=void 0;try{for(var i,l=e[Symbol.iterator]();!(r=(i=l.next()).done)&&(n.push(i.value),!t||n.length!==t);r=!0);}catch(c){o=!0,a=c}finally{try{r||null==l.return||l.return()}finally{if(o)throw a}}return n}},54:function(e,t){e.exports=function(){throw new TypeError("Invalid attempt to destructure non-iterable instance")}},63:function(e,t,n){"use strict";var r=n(21),o=n.n(r),a=n(7),i=n.n(a),l=n(11),c=n.n(l),s=n(8),u=n.n(s),p=n(9),f=n.n(p),d=n(4),m=n.n(d),b=n(10),h=n.n(b),v=n(3),y=n.n(v),g=n(0),k=n(1),w=n(5),j=n(2),x=(n(81),function(e){function t(){var e,n;i()(this,t);for(var r=arguments.length,o=new Array(r),a=0;a<r;a++)o[a]=arguments[a];return n=u()(this,(e=f()(t)).call.apply(e,[this].concat(o))),y()(m()(n),"handleClick",function(){(0,n.props.onClick)(m()(n))}),y()(m()(n),"getPoint",function(){var e=n.props.point;return[e.coordinates.longitude,e.coordinates.latitude]}),n}return h()(t,e),c()(t,[{key:"componentDidMount",value:function(){this.renderMarker()}},{key:"componentWillUnmount",value:function(){this.marker&&this.marker.remove()}},{key:"componentDidUpdate",value:function(){this.renderMarker()}},{key:"renderMarker",value:function(){var e=this.props,t=e.map,n=e.point,r=e.mapboxgl,o=e.markerColor,a=this.handleClick,i=[n.coordinates.longitude,n.coordinates.latitude],l=this.marker?this.marker.getElement():document.createElement("div");this.marker?this.marker.setLngLat(i):(l.className="wp-block-jetpack-map-marker",this.marker=new r.Marker(l).setLngLat(i).setOffset([0,-19]).addTo(t),this.marker.getElement().addEventListener("click",a)),l.innerHTML='<?xml version="1.0" encoding="UTF-8"?><svg version="1.1" viewBox="0 0 32 38" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g fill-rule="evenodd"><path id="d" d="m16 38s16-11.308 16-22-7.1634-16-16-16-16 5.3076-16 16 16 22 16 22z" fill="'+o+'" mask="url(#c)"/></g></svg>'}},{key:"render",value:function(){return null}}]),t}(g.Component));x.defaultProps={point:{},map:null,markerColor:"#000000",mapboxgl:null,onClick:function(){}};var O=x,M=function(e){function t(){var e,n;i()(this,t);for(var r=arguments.length,o=new Array(r),a=0;a<r;a++)o[a]=arguments[a];return n=u()(this,(e=f()(t)).call.apply(e,[this].concat(o))),y()(m()(n),"closeClick",function(){n.props.unsetActiveMarker()}),n}return h()(t,e),c()(t,[{key:"componentDidMount",value:function(){var e=this.props.mapboxgl;this.el=document.createElement("DIV"),this.infowindow=new e.Popup({closeButton:!0,closeOnClick:!1,offset:{left:[0,0],top:[0,5],right:[0,0],bottom:[0,-40]}}),this.infowindow.setDOMContent(this.el),this.infowindow.on("close",this.closeClick)}},{key:"componentDidUpdate",value:function(e){this.props.activeMarker!==e.activeMarker&&(this.props.activeMarker?this.openWindow():this.closeWindow())}},{key:"render",value:function(){return this.el?Object(g.createPortal)(this.props.children,this.el):null}},{key:"openWindow",value:function(){var e=this.props,t=e.map,n=e.activeMarker;this.infowindow.setLngLat(n.getPoint()).addTo(t)}},{key:"closeWindow",value:function(){this.infowindow.remove()}}]),t}(g.Component);M.defaultProps={unsetActiveMarker:function(){},activeMarker:null,map:null,mapboxgl:null};var C=M;var _=function(e){function t(){var e;return i()(this,t),e=u()(this,f()(t).apply(this,arguments)),y()(m()(e),"onMarkerClick",function(t){var n=e.props.onMarkerClick;e.setState({activeMarker:t}),n()}),y()(m()(e),"onMapClick",function(){e.setState({activeMarker:null})}),y()(m()(e),"clearCurrentMarker",function(){e.setState({activeMarker:null})}),y()(m()(e),"updateActiveMarker",function(t){var n=e.props.points,r=e.state.activeMarker.props.index,o=n.slice(0);Object(w.assign)(o[r],t),e.props.onSetPoints(o)}),y()(m()(e),"deleteActiveMarker",function(){var t=e.props.points,n=e.state.activeMarker.props.index,r=t.slice(0);r.splice(n,1),e.props.onSetPoints(r),e.setState({activeMarker:null})}),y()(m()(e),"sizeMap",function(){var t=e.state.map,n=e.mapRef.current,r=n.offsetWidth,o=.8*window.innerHeight,a=Math.min(.75*r,o);n.style.height=a+"px",t.resize(),e.setBoundsByMarkers()}),y()(m()(e),"setBoundsByMarkers",function(){var t=e.props,n=t.zoom,r=t.points,o=t.onSetZoom,a=e.state,i=a.map,l=a.activeMarker,c=a.mapboxgl,s=a.zoomControl,u=a.boundsSetProgrammatically;if(i&&r.length&&!l){var p=new c.LngLatBounds;if(r.forEach(function(e){p.extend([e.coordinates.longitude,e.coordinates.latitude])}),r.length>1)return i.fitBounds(p,{padding:{top:40,bottom:40,left:20,right:20}}),e.setState({boundsSetProgrammatically:!0}),void i.removeControl(s);if(i.setCenter(p.getCenter()),u){i.setZoom(12),o(12)}else i.setZoom(parseInt(n,10));i.addControl(s),e.setState({boundsSetProgrammatically:!1})}}),y()(m()(e),"scriptsLoaded",function(){var t=e.props,n=t.mapCenter,r=t.points;e.setState({loaded:!0}),r.length,e.initMap(n)}),e.state={map:null,fit_to_bounds:!1,loaded:!1,mapboxgl:null},e.mapRef=Object(g.createRef)(),e.debouncedSizeMap=Object(w.debounce)(e.sizeMap,250),e}return h()(t,e),c()(t,[{key:"render",value:function(){var e=this,t=this.props,n=t.points,r=t.admin,o=t.children,a=t.markerColor,i=this.state,l=i.map,c=i.activeMarker,s=i.mapboxgl,u=this.onMarkerClick,p=this.deleteActiveMarker,f=this.updateActiveMarker,d=Object(w.get)(c,"props.point")||{},m=d.title,b=d.caption,h=g.Children.map(o,function(e){if("AddPoint"===Object(w.get)(e,"props.tagName"))return e}),v=l&&s&&n.map(function(e,t){return Object(g.createElement)(O,{key:t,point:e,index:t,map:l,mapboxgl:s,markerColor:a,onClick:u})}),y=s&&Object(g.createElement)(C,{activeMarker:c,map:l,mapboxgl:s,unsetActiveMarker:function(){return e.setState({activeMarker:null})}},c&&r&&Object(g.createElement)(g.Fragment,null,Object(g.createElement)(j.TextControl,{label:Object(k.__)("Marker Title","jetpack"),value:m,onChange:function(e){return f({title:e})}}),Object(g.createElement)(j.TextareaControl,{className:"wp-block-jetpack-map__marker-caption",label:Object(k.__)("Marker Caption","jetpack"),value:b,rows:"2",tag:"textarea",onChange:function(e){return f({caption:e})}}),Object(g.createElement)(j.Button,{onClick:p,className:"wp-block-jetpack-map__delete-btn"},Object(g.createElement)(j.Dashicon,{icon:"trash",size:"15"})," ",Object(k.__)("Delete Marker","jetpack"))),c&&!r&&Object(g.createElement)(g.Fragment,null,Object(g.createElement)("h3",null,m),Object(g.createElement)("p",null,b)));return Object(g.createElement)(g.Fragment,null,Object(g.createElement)("div",{className:"wp-block-jetpack-map__gm-container",ref:this.mapRef},v),y,h)}},{key:"componentDidMount",value:function(){this.props.apiKey&&this.loadMapLibraries()}},{key:"componentWillUnmount",value:function(){this.debouncedSizeMap.cancel()}},{key:"componentDidUpdate",value:function(e){var t=this.props,n=t.apiKey,r=t.children,o=t.points,a=t.mapStyle,i=t.mapDetails,l=this.state.map;n&&n.length>0&&n!==e.apiKey&&this.loadMapLibraries(),r!==e.children&&!1!==r&&this.clearCurrentMarker(),o!==e.points&&this.setBoundsByMarkers(),o.length!==e.points.length&&this.clearCurrentMarker(),a===e.mapStyle&&i===e.mapDetails||l.setStyle(this.getMapStyle())}},{key:"getMapStyle",value:function(){var e=this.props;return function(e,t){return{default:{details:"mapbox://styles/automattic/cjolkhmez0qdd2ro82dwog1in",no_details:"mapbox://styles/automattic/cjolkci3905d82soef4zlmkdo"},black_and_white:{details:"mapbox://styles/automattic/cjolkixvv0ty42spgt2k4j434",no_details:"mapbox://styles/automattic/cjolkgc540tvj2spgzzoq37k4"},satellite:{details:"mapbox://styles/mapbox/satellite-streets-v10",no_details:"mapbox://styles/mapbox/satellite-v9"},terrain:{details:"mapbox://styles/automattic/cjolkf8p405fh2soet2rdt96b",no_details:"mapbox://styles/automattic/cjolke6fz12ys2rpbpvgl12ha"}}[e][t?"details":"no_details"]}(e.mapStyle,e.mapDetails)}},{key:"getMapType",value:function(){switch(this.props.mapStyle){case"satellite":return"HYBRID";case"terrain":return"TERRAIN";case"black_and_white":default:return"ROADMAP"}}},{key:"loadMapLibraries",value:function(){var e=this,t=this.props.apiKey;Promise.all([n.e(11).then(n.t.bind(null,285,7)),n.e(11).then(n.t.bind(null,286,7))]).then(function(n){var r=o()(n,1)[0].default;r.accessToken=t,e.setState({mapboxgl:r},e.scriptsLoaded)})}},{key:"initMap",value:function(e){var t=this,n=this.state.mapboxgl,r=this.props,o=r.zoom,a=r.onMapLoaded,i=r.onError,l=r.admin,c=null;try{c=new n.Map({container:this.mapRef.current,style:this.getMapStyle(),center:this.googlePoint2Mapbox(e),zoom:parseInt(o,10),pitchWithRotate:!1,attributionControl:!1,dragRotate:!1})}catch(u){return void i("mapbox_error",u.message)}c.on("error",function(e){i("mapbox_error",e.error.message)});var s=new n.NavigationControl({showCompass:!1,showZoom:!0});c.on("zoomend",function(){t.props.onSetZoom(c.getZoom())}),c.getCanvas().addEventListener("click",this.onMapClick),this.setState({map:c,zoomControl:s},function(){t.debouncedSizeMap(),c.addControl(s),l||c.addControl(new n.FullscreenControl),t.mapRef.current.addEventListener("alignmentChanged",t.debouncedSizeMap),c.resize(),a(),t.setState({loaded:!0}),window.addEventListener("resize",t.debouncedSizeMap)})}},{key:"googlePoint2Mapbox",value:function(e){return[e.longitude?e.longitude:0,e.latitude?e.latitude:0]}}]),t}(g.Component);_.defaultProps={points:[],mapStyle:"default",zoom:13,onSetZoom:function(){},onMapLoaded:function(){},onMarkerClick:function(){},onError:function(){},markerColor:"red",apiKey:null,mapCenter:{}};t.a=_},7:function(e,t){e.exports=function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}},70:function(e,t){e.exports=function(e){if(Array.isArray(e)){for(var t=0,n=new Array(e.length);t<e.length;t++)n[t]=e[t];return n}}},71:function(e,t){e.exports=function(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}},72:function(e,t){e.exports=function(){throw new TypeError("Invalid attempt to spread non-iterable instance")}},75:function(e,t){function n(e){return(n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function r(t){return"function"==typeof Symbol&&"symbol"===n(Symbol.iterator)?e.exports=r=function(e){return n(e)}:e.exports=r=function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":n(e)},r(t)}e.exports=r},76:function(e,t){function n(t,r){return e.exports=n=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e},n(t,r)}e.exports=n},8:function(e,t,n){var r=n(75),o=n(4);e.exports=function(e,t){return!t||"object"!==r(t)&&"function"!=typeof t?o(e):t}},81:function(e,t,n){},83:function(e,t,n){},9:function(e,t){function n(t){return e.exports=n=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)},n(t)}e.exports=n}}));