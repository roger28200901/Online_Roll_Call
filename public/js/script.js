console.log = function() {

}
const video = document.getElementById('videoInput')
let rollcall_time = new Date($('[name=rollcall_time]').val())
let rollcall_time_plus_delay = new Date($('[name=rollcall_time_plus_delay]').val())
var mjpeg_img;
var labels = [] // for WebCam


function reload_img() {
    mjpeg_img.src = "http://172.20.10.2/cam_pic.php?time=" + new Date().getTime();
}

function error_img() {
    console.log('error_img')
    setTimeout("mjpeg_img.src = 'http://172.20.10.2/cam_pic.php?time=' + new Date().getTime();", 100);
}

function refreshStream() {
    $('#mjpeg_dest').attr('src', "http://172.20.10.2/cam_pic.php?time=" + new Date().getTime());
}

function init() {
    console.log('init')

    // json
    $.getJSON('users.json', function(json) {
        json.forEach(function(student) {
            labels.push(student.name)
        })
    })
    mjpeg_img = document.getElementById("mjpeg_dest");
    // setTimeout(refreshStream, 150);
    // mjpeg_img.onload = refreshStream;
    // console.log(loadImage());
    // mjpeg_img.onerror = error_img;
    // reload_img();
    loadImage()
}

function loadImage(url) {
    url = "http://172.20.10.2/cam_pic.php?time=" + new Date().getTime();
    return new Promise((resolve, reject) => {
        const img = $('#mjpeg_img')

        img.onload = () => resolve(img)
        img.onerror = () => reject(new Error('Failed to load image'))
        reload_img()
    })
}
Promise.all([
    //載入訓練好的模型（weight，bias）
    // ageGenderNet 識別性別和年齡
    // faceExpressionNet 識別表情,開心，沮喪，普通
    // faceLandmark68Net 識別臉部特徵用於mobilenet演算法
    // faceLandmark68TinyNet 識別臉部特徵用於tiny演算法
    // faceRecognitionNet 識別人臉
    // ssdMobilenetv1 google開源AI演算法除庫包含分類和線性迴歸
    // tinyFaceDetector 比Google的mobilenet更輕量級，速度更快一點
    // mtcnn  多工CNN演算法，一開瀏覽器就卡死
    // tinyYolov2 識別身體輪廓的演算法，不知道怎麼用
    faceapi.nets.faceRecognitionNet.loadFromUri('public/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('public/models'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('public/models'), //heavier/accurate version of tiny face detector
    // faceapi.nets.faceRecognitionNet.loadFromUri('https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights'),
    // faceapi.nets.faceLandmark68Net.loadFromUri('https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights'),
    // faceapi.nets.faceLandmark68TinyNet.loadFromUri('https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights'),
    // faceapi.nets.tinyFaceDetector.loadFromUri('https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights'),
    // faceapi.nets.mtcnn.loadFromUri('https://raw.githubusercontent.com/justadudewhohacks/face-api.js/master/weights'),

]).then(start)

function start() {
    document.body.append('Models Loaded')

    // navigator.getUserMedia({ video: {} },
    //     stream => video.srcObject = stream,
    //     err => console.error(err)
    // )


    // var constraints = { audio: true, video: true }; 

    // navigator.mediaDevices.getUserMedia(constraints)
    // .then(function(mediaStream) {
    //   var video = document.querySelector('video');
    //   video.srcObject = mediaStream;
    //   video.onloadedmetadata = function(e) {
    //     video.play();
    //   };
    // })
    // .catch(function(err) { console.log(err.name + ": " + err.message); });


    //video.src = '../videos/speech.mp4'
    // console.log('video added')


    recognizeFaces()
}

var persons = [{
    "name": "陳昀鴻",
    "count": 0,
}]


async function recognizeFaces() {

    const input = document.getElementById('mjpeg_dest')

    const canvas = document.getElementById('overlay')




    const displaySize = { width: input.width, height: input.height }
    faceapi.matchDimensions(canvas, displaySize)

    console.log('enter recognizeFaces')
    const labeledDescriptors = await loadLabeledImages()
    console.log(labeledDescriptors)
    const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.3)

    setInterval(async() => {
        const options = new faceapi.SsdMobilenetv1Options({ minConfidence: 0.38 })
        await refreshStream();
        const detections = await faceapi.detectAllFaces(input, options).withFaceLandmarks().withFaceDescriptors()

        // resize the detected boxes in case your displayed image has a different size then the original
        const resizedDetections = faceapi.resizeResults(detections, { width: input.width, height: input.height })

        // draw them into a canvas
        // const canvas = document.getElementById('overlay')
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)
        canvas.width = input.width
        canvas.height = input.height
            // faceapi.drawDetection(canvas, resizedDetections, { withScore: true })
        console.log(resizedDetections);
        const results = resizedDetections.map((d) => {
                return faceMatcher.findBestMatch(d.descriptor)
            })
            // const sortAsc = (a, b) => a - b

        // const results = resizedDetections.map((fd, i) => {
        //     const bestMatch = labeledDescriptors.map(
        //         refDesc => ({
        //             label: labels[i],
        //             distance: faceapi.euclideanDistance(fd.descriptor, refDesc)
        //         })
        //     ).sort(sortAsc)[0]

        //     return {
        //         detection: fd.detection,
        //         label: bestMatch.label,
        //         distance: bestMatch.distance
        //     }
        // })

        console.log(results)

        results.forEach((result, i) => {

            persons.forEach(function(person) {
                if (person.name == result.label) person.count += 1
                if (person.count == 10) {
                    let now = new Date();

                    if (now.getTime() >= rollcall_time.getTime() && now.getTime() <= rollcall_time_plus_delay.getTime()) {
                        status = "準時";
                    } else if (now.getTime() >= rollcall_time_plus_delay) {
                        status = "遲到";
                    }
                    console.log(person.count)
                    console.log(status)
                    $.ajax({
                        url: 'insert_detect.php',
                        method: 'POST',
                        data: {
                            "name": person.name,
                            "status": status,
                        },
                        success: function(response) {
                            console.log(response)
                            person.count = 0;
                        }
                    })
                }
            })

            const box = resizedDetections[i].detection.box
            const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
            drawBox.draw(canvas)
        })

    }, 100)




    // video.addEventListener('play', async() => {
    //     console.log('Playing')



    // const canvas = faceapi.createCanvasFromMedia(video)
    // document.body.append(canvas)

    // const displaySize = { width: video.width, height: video.height }
    // faceapi.matchDimensions(canvas, displaySize)



    // setInterval(async() => {
    //     const detections = await faceapi.detectAllFaces(video).withFaceLandmarks().withFaceDescriptors()

    //     const resizedDetections = faceapi.resizeResults(detections, displaySize)

    //     canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)

    //     const results = resizedDetections.map((d) => {
    //         return faceMatcher.findBestMatch(d.descriptor)
    //     })
    //     console.log(results)
    //     results.forEach((result, i) => {
    //         const box = resizedDetections[i].detection.box
    //         const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
    //         drawBox.draw(canvas)
    //     })
    // }, 100)



    // })
}


function loadLabeledImages() {
    //const labels = ['Black Widow', 'Captain America', 'Hawkeye' , 'Jim Rhodes', 'Tony Stark', 'Thor', 'Captain Marvel']

    return Promise.all(
        labels.map(async(label) => {
            const descriptions = []
            for (let i = 1; i <= 2; i++) {
                // $.get(`public/labeled_images/${label}/`)
                //     .done(function() {
                //         // exists code 
                //         console.log(label + "存在")
                //     }).fail(function() {
                //         // not exists code
                //         console.log("不存在")
                //     })

                if (UrlExists(`public/labeled_images/${label}/${i}.jpg`) == false) break;
                const img = await faceapi.fetchImage(`public/labeled_images/${label}/${i}.jpg`)
                const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
                descriptions.push(detections.descriptor)
            }
            // document.body.append(label + ' Faces Loaded | ')
            return new faceapi.LabeledFaceDescriptors(label, descriptions)
        })
    )
}

function UrlExists(url) {
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status != 404;
}