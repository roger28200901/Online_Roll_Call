
#!/usr/bin/python

import pymysql
from google.cloud import texttospeech
import time
name = ""
while True:
    con = pymysql.connect(host='localhost',  port=3306, user='admin', passwd='1234', db='midterm', charset='utf8')
    con.autocommit = True

    with con.cursor() as cur:

        cur.execute('SELECT * FROM `students` ORDER BY `students`.`time` DESC')

        row = cur.fetchone()
        # id rollcalls_id name
        # print(f'{row[0]} {row[1]} {row[2]}')
        if row == None:
            name == ""
            continue
        
        if (name == "" or name != row[2]):
            name = row[2]
            # Instantiates a client
            client = texttospeech.TextToSpeechClient()

            # Set the text input to be synthesized
            synthesis_input = texttospeech.SynthesisInput(text=name + "恭喜簽到了")

            # Build the voice request, select the language code ("en-US") and the ssml
            # voice gender ("neutral")
            voice = texttospeech.VoiceSelectionParams(
                    language_code="zh", ssml_gender=texttospeech.SsmlVoiceGender.NEUTRAL
            )

            # Select the type of audio file you want returned
            audio_config = texttospeech.AudioConfig(
                    audio_encoding=texttospeech.AudioEncoding.MP3
            )

            # Perform the text-to-speech request on the text input with the selected
            # voice parameters and audio file type
            response = client.synthesize_speech(
                input=synthesis_input, voice=voice, audio_config=audio_config
            )

            # The response's audio_content is binary.
            with open("output.mp3", "wb") as out:
                # Write the response to the output file.
                out.write(response.audio_content)
                # print('Audio content written to file "output.mp3"')
                print(name)
        elif (name == row[2]):
            continue
    cur.close()
    time.sleep(1)
    

    
    

