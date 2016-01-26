var d_headIndex = document.getElementById("d_headIndex");
var d_leftAside = document.getElementById("d_leftAside_artical");
var p_title = document.getElementById("p_title");
var p_content = document.getElementById("p_content");
var header = document.getElementById("header");

function change_html(id) {
	var dataTitle = [];//textNode
	var dataPath = [];
	var dataSplit = [];
	var newTag_div = [];
	var newTag_a = [];
	var newText = [];//textNode's content
	var newSpan = [];
	var dataLength = 0;
	var tag_aLength = 0;
	var dataPoint = 0;
	var deletePoint = 0;
	var isLB = 0;

	//read text from #dataPath
	var textData;
	if (window.XMLHttpRequest) {
		textData = new XMLHttpRequest();
		textData.onreadystatechange = function() {
			//if (textData.readyState == 4 && textData.status == 200)
			if (textData.readyState == 4)
			{

				//clear headIndex,leftAside,p_title,p_content.
				p_title.innerHTML = "";
				p_content.innerHTML = "";
				deletePoint = d_leftAside.childNodes.length;
				while (deletePoint > 0) {
					d_leftAside.removeChild(d_leftAside.childNodes[deletePoint - 1]);
					deletePoint -= 1;
				}
				deletePoint = d_headIndex.childNodes.length;
				while (deletePoint > 0) {
					d_headIndex.removeChild(d_headIndex.childNodes[deletePoint - 1]);
					deletePoint -= 1;
				}

				//build headIndex
				dataSplit = textData.responseText.split("\n");
				dataLength = dataSplit.length - 1;
				indexLength = dataSplit[0].split(":")[0]
				dataPoint += 1;
				while (dataPoint <= indexLength) {
					newTag_a[dataPoint] = document.createElement("a");
					newSpan[dataPoint] = document.createElement("span");
					dataPath[dataPoint] = dataSplit[dataPoint].split(":")[0];
					newText[dataPoint] = dataSplit[dataPoint].split(":")[1];
					dataTitle[dataPoint] = document.createTextNode(newText[dataPoint]);
					newSpan[dataPoint].appendChild(document.createTextNode(" "));
					newTag_a[dataPoint].href = dataPath[dataPoint];
					newTag_a[dataPoint].onclick = function(){change_html(this.hash)};
					newTag_a[dataPoint].className = "a_index";
					newTag_a[dataPoint].appendChild(dataTitle[dataPoint]);
					d_headIndex.appendChild(newTag_a[dataPoint]);
					//d_headIndex.appendChild(newSpan[dataPoint]);
					dataPoint += 1;
				}
				newSpan[dataPoint] = document.createElement("span");
				newSpan[dataPoint].className = "span_title";
				newSpan[dataPoint].style.backgroundColor = "#cde";
				newSpan[dataPoint].appendChild(document.createTextNode(dataSplit[0].split(":")[1]));
				d_headIndex.appendChild(newSpan[dataPoint]);

				//add d_leftAside's title
				tag_aLength = parseInt(dataSplit[dataPoint].split(":")[0]) + dataPoint;
				dataTitle[dataPoint] = document.createElement("p");
				dataTitle[dataPoint].className = "p_aside_title";
				dataTitle[dataPoint].appendChild(document.createTextNode("[" + dataSplit[dataPoint].split(":")[1] + "]"));
				d_leftAside.appendChild(dataTitle[dataPoint]);

				//add content into d_leftAside
				dataPoint += 1;
				while (dataPoint <= tag_aLength) {
					newTag_div[dataPoint] = document.createElement("div");
					newTag_a[dataPoint] = document.createElement("a");
					dataTitle[dataPoint] = document.createElement("p");
					newTag_div[dataPoint].className = "d_leftAside_content";
					newTag_a[dataPoint].className = "a_aside_content";
					if (1 == (tag_aLength - dataPoint) % 2) {
						dataTitle[dataPoint].className = "p_aside_content_alpha";
					}
					else {
						dataTitle[dataPoint].className = "p_aside_content";
					}
					dataPath[dataPoint] = dataSplit[dataPoint].split(":")[0];
					newTag_a[dataPoint].href = dataPath[dataPoint];
					newTag_a[dataPoint].onclick = function(){change_html(this.hash)};
					newText[dataPoint] = dataSplit[dataPoint].split(":")[1];
					dataTitle[dataPoint].appendChild(document.createTextNode(newText[dataPoint]));
					newTag_a[dataPoint].appendChild(dataTitle[dataPoint]);
					newTag_div[dataPoint].appendChild(newTag_a[dataPoint]);
					d_leftAside.appendChild(newTag_div[dataPoint]);
					dataPoint += 1;
				}

				//here add p_title and p_content
				p_title.innerHTML = dataSplit[dataPoint];
				dataPoint += 1;
				p_content.innerHTML += "　　";
				while (dataPoint < dataLength) {
					p_content.innerHTML +=　 dataSplit[dataPoint];
					p_content.innerHTML += "<br/>　　";
					dataPoint += 1;
				}
			}
		}
		textData.open("GET","./text/" + id.replace("#",""),true);
		textData.send();
	}
	return;
}

function bodyonload() {
	var w_hash = window.location.hash;
	if ("" == w_hash) {
		change_html("#home/blog_data");
	} else {
		change_html(w_hash);
	}
	return;
}
