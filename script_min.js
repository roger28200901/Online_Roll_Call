var mjpeg_img;

function reload_img() {
    mjpeg_img.src = "http://172.20.10.2/cam_pic.php?time=" + new Date().getTime();
}

function error_img() {
    setTimeout("mjpeg_img.src = 'http://172.20.10.2/cam_pic.php?time=' + new Date().getTime();", 100);
}

function init() {
    console.log('init')
    mjpeg_img = document.getElementById("mjpeg_dest");
    mjpeg_img.onload = reload_img;
    mjpeg_img.onerror = error_img;
    reload_img();
}