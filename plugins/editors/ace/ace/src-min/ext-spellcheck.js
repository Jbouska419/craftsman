ace.define("ace/ext/spellcheck",["require","exports","module","ace/editor","ace/config"],function(e,t,n){t.contextMenuHandler=function(e){var t=e.target,n=t.textInput.getElement();if(!t.selection.isEmpty())return;var r=t.getCursorPosition(),i=t.session.getWordRange(r.row,r.column),s=t.session.getTextRange(i);t.session.tokenRe.lastIndex=0;if(!t.session.tokenRe.test(s))return;var o="",u=s+" "+o;n.value=u,n.setSelectionRange(s.length+1,s.length+1),n.setSelectionRange(0,0),t.textInput.setInputHandler(function(e){if(e==u)return"";if(e.lastIndexOf(u)==e.length-u.length)return e.slice(0,-u.length);if(e.indexOf(u)===0)return e.slice(u.length);if(e.slice(-2)==o){var n=e.slice(0,-2);if(n.slice(-1)==" ")return n=n.slice(0,-1),t.session.replace(i,n),""}return e})};var r=e("../editor").Editor;e("../config").defineOptions(r.prototype,"editor",{spellcheck:{set:function(e){var n=this.textInput.getElement();n.spellcheck=!!e,e?this.on("nativecontextmenu",t.contextMenuHandler):this.removeListener("nativecontextmenu",t.contextMenuHandler)},value:!0}})})