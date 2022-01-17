// console.log = function() {

// }
const video = document.getElementById('videoInput')
let rollcall_time = new Date($('[name=rollcall_time]').val())
let rollcall_time_plus_delay = new Date($('[name=rollcall_time_plus_delay]').val())
var mjpeg_img;
var labels = [] // for WebCam
var labelsFiles = []
var persons = []
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
    $('#loadMe').modal({
        backdrop: 'static',
        keyboard: false
    })
    $('#loadMe').modal('show')

    // json
    // $.getJSON('users.json', function(json) {
    //     json.forEach(function(student) {
    //         labels.push(student.name)
    //     })
    // })
    $.ajax({
        url: 'get_model_list.php',
        method: 'GET',
        success: function(responses) {
            let json = JSON.parse(responses)
            json.forEach(function(response) {
                labels.push(response.name);
                let person = {
                    "name": response.name,
                    "count": 0
                }
                persons.push(person)
            })
        }
    })
    $.ajax({
        url: 'get_model_files.php',
        method: 'GET',
        success: function(responses) {
            let json = JSON.parse(responses);
            json.forEach(function(object) {
                labelsFiles.push(object)
            })
            console.log(labels, labelsFiles)

        }
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
    recognizeFaces()
}




async function recognizeFaces() {

    const input = document.getElementById('mjpeg_dest')

    const canvas = document.getElementById('overlay')

    const displaySize = { width: input.width, height: input.height }
    faceapi.matchDimensions(canvas, displaySize)

    console.log('enter recognizeFaces')
    const labeledDescriptors = await loadLabeledImages()
    $('#loadMe').modal('hide')
    console.log(labeledDescriptors)
    const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.6)

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
            // console.log(resizedDetections);
        const results = resizedDetections.map((d) => {
            return faceMatcher.findBestMatch(d.descriptor)
        })

        results.forEach((result, i) => {

            persons.forEach(function(person) {
                if (person.name == result.label) person.count += 1
                if (person.count == 20) {
                    let now = new Date();
                    let status = '準時';
                    if (now.getTime() >= rollcall_time.getTime() && now.getTime() <= rollcall_time_plus_delay.getTime()) {
                        status = "準時";
                    } else if (now.getTime() >= rollcall_time_plus_delay) {
                        status = "遲到";
                    }
                    console.log(person.count)
                    console.log(status)
                    let rollcall_id = $('[name=rollcall_id]').val()
                    $.ajax({
                        url: 'insert_detect.php',
                        method: 'POST',
                        data: {
                            "name": person.name,
                            "status": status,
                            "rollcall_id": rollcall_id
                        },
                        success: function(response) {
                            console.log(response)
                            person.count = 0;
                            let count = 0;
                            $.ajax({
                                url: 'update.php',
                                type: 'GET',
                                dataType: 'json',
                                data: {
                                    "rollcall_time": $('[name=rollcall_time]').val().split(' ')[0]
                                },
                                success: function(responses) {
                                    $('#left_container').empty();
                                    responses.forEach(function(response) {
                                        count += 1;
                                        let tag = `
                                                    <div class="grid-item">
                                                        <div class="flex">
                                                            <i class="user fas fa-user-circle"></i>
                                                            <div class="information">
                                                                <span>姓名:${response.name}</span>
                                                                <span>學號:${response.school_number}</span>
                                                                <span>簽到時間:${response.time}</span>
                                                                <span class="${response.status == '準時' ? 'text-success' : 'text-danger'}">狀態：${response.status}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    `
                                        $('#left_container').append(tag);
                                    })
                                    $('#toast-content').html(person.name +" 辨識成功 "+ " 狀態：" + status )
                                    // TODO:fix 
                                    var audio = new Audio("output.mp3");
                                                                        
                                    const videoPromise = video.play();

                                        if (videoPromise !== undefined) {
                                        playPromise.then(() => {
                                                // Automatic playback started!
                                                // Show playing UI.
                                                $('.toast').toast('show');

                                            })
                                            .catch(error => {
                                                // Auto-play was prevented
                                                // Show paused UI.
                                            });
                                        }
                                    $('#count_people').html('目前已到人數:' + count + '人')


                                }
                            })
                        }
                    })
                }
            })

            const box = resizedDetections[i].detection.box
            const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
            drawBox.draw(canvas)
        })

    }, 100)

}

function loadLabeledImages() {
    // const labels = ['郭芝玲','李佩佳','陳昀鴻','李佳霖']
    return Promise.all(
        labels.map(async(label, index) => {
            const descriptions = []
                // console.log(index)

            // labelsFiles.forEach(function (item) {
            //     if (item.name == label) {
            //         item.images.forEach(element => {
            //             console.log(item.name + element)
            //             // if (UrlExists(`public/labeled_images/${label}/${element}.jpg`) == false) break;
            //             console.log(`public/labeled_images/${label}/${element}`);
            //             // const img = await faceapi.fetchImage(`public/labeled_images/${label}/${element}`)
            //             // const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
            //             // descriptions.push(detections.descriptor)
            //         });
            //     }                
            // })
            for (let i = 0; i < labelsFiles.length; i++) {
                if (labelsFiles[i].name == label) {
                    for (let j = 0; j < labelsFiles[i].images.length; j++) {
                        const img = await faceapi.fetchImage(`public/labeled_images/${label}/${labelsFiles[i].images[j]}`)
                        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
                        descriptions.push(detections.descriptor)
                    }
                }
            }
            // for (let i = 1; i <= 2; i++) {
            //     if (UrlExists(`public/labeled_images/${label}/${i}.jpg`) == false) break;
            //     const img = await faceapi.fetchImage(`public/labeled_images/${label}/${i}.jpg`)
            //     const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
            //     descriptions.push(detections.descriptor)
            // }
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