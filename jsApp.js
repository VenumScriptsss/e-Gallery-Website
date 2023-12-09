const	realUploadFile = document.getElementById("realUploadFile");
const	uploadSubmit = document.getElementById("uploadSub");
const	uploadClone = document.getElementById("uploadClone");
const	uploadSubClone = document.getElementById("subClone");

uploadClone.addEventListener("click",function(){
	realUploadFile.click();
	/*uploadSubmit.click();*/

});


const preview = document.querySelector(".preview");
const images = document.querySelectorAll(".pics img");
const previmg = document.querySelector(".preview-img");
const caption = document.querySelector(".caption");

images.forEach((img) => {
	img.addEventListener("click",() => {
		preview.classList.add("on");
		const imgtext = img.getAttribute("data-original");
		const imgsrc = img.getAttribute("src");
		previmg.src = imgsrc;
		const keys= document.querySelectorAll(".icon-cont button");
		keys.forEach((key)=>{
			key.value=imgsrc;
			
		})
		
		caption.textContent = imgtext;
		
	});
});

preview.addEventListener("click",(e)=>{
	if (e.target.classList.contains("preview")) {
		preview.classList.remove("on");		
		albmform.classList.remove("on");		
	}
});

const keyimg= document.querySelector(".addalbum-img img");
const albmform = document.querySelector(".albumform");
keyimg.addEventListener("click",()=>{
	albmform.classList.add("on");
});




