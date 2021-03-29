<?php
//### from http://www.mp3quran.net ###//
/*
0- الاسم بالعربي
1- الاسم بالانجليزي
2- رابط مجلد الملفات الصوتيه ويجب ان يكون ترتيبها كالتالي 001,002,003,004,010,011,012,013,110,111,112,113,114 وهكذا
3- ملاحظات بالعربي
4- ملاحظات بالانجليزي
*/
$readers_sora = array(
"1"=>array("سعد الغامدي","Ghamadi","http://download.quranicaudio.com/quran/sa3d_al-ghaamidi/complete","",""),
"2"=>array("الحذيفي","Hudhaify","http://download.quranicaudio.com/quran/huthayfi","",""),
"3"=>array("محسن القاسم","abdul_muhsin_alqasim","http://download.quranicaudio.com/quran/abdul_muhsin_alqasim","",""),
"4"=>array("عبد العزيز الاحمد","abdulazeez_al-ahmad","http://download.quranicaudio.com/quran/abdulazeez_al-ahmad","",""),
"5"=>array("عبد الباسط مجود","abdulbaset_mujawwad","http://download.quranicaudio.com/quran/abdulbaset_mujawwad","",""),
"6"=>array("عبد الباشط ورش","abdulbaset_warsh","http://download.quranicaudio.com/quran/abdulbaset_warsh","",""),
"7"=>array("عبد الباسط","Abdul_Basit_Murattal_64kbps","http://download.quranicaudio.com/quran/abdul_basit_murattal","",""),
"8"=>array("ابو بكر الشاطري ","abu_bakr_ash-shaatree","http://download.quranicaudio.com/quran/abu_bakr_ash-shaatree","",""),
"9"=>array("إبراهيم الدوسري (ورش)","warsh_dossary_128kbps","http://download.quranicaudio.com/quran/yasser_ad-dussary","",""),
"10"=>array("احمد إبن علي العجمي","ahmed_ibn_3ali_al-3ajamy","http://download.quranicaudio.com/quran/ahmed_ibn_3ali_al-3ajamy","",""));
############
$readers_ayat_1 = array(
"1"=>array("سعد الغامدي","Ghamadi_40kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Ghamadi_40kbps","",""),
"2"=>array("لحذيفي","Hudhaify_32kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Hudhaify_64kbps","",""),
"3"=>array("الحصري","Husary_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Husary_64kbps","",""),
"4"=>array("الحصري مجود","Husary_Mujawwad_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Husary_Mujawwad_64kbps","",""),
"5"=>array("المنشاوي","Menshawi_16kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Minshawy_Murattal_128kbps","",""),
"6"=>array("المنشاوي مجود","Minshawy_Mujawwad_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Minshawy_Mujawwad_64kbps","",""),
"7"=>array("عبد الباسط","Abdul_Basit_Murattal_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Abdul_Basit_Murattal_64kbps","",""),
"8"=>array("عبد الباسط - مجود ","AbdulSamad_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/AbdulSamad_64kbps","",""),
"9"=>array("عبد الله بصفر","Abdullah_Basfar_32kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Abdullah_Basfar_32kbps","",""),
"10"=>array("ماهر المعيقلى ","Maher_AlMuaiqly_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Maher_AlMuaiqly_64kbps","",""),
"11"=>array("محمد أيوب البورمي","Muhammad_Ayyoub_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Muhammad_Ayyoub_64kbps","",""),
"12"=>array("الطبلاوي","Mohammad_al_Tablaway_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Mohammad_al_Tablaway_64kbps","",""),
"13"=>array("محمود البنا","Banna_32kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Banna_32kbps","",""),
"14"=>array("إبراهيم الأخضر","Ibrahim_Akhdar_32kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Ibrahim_Akhdar_32kbps","",""),
"15"=>array("عبد الرحمن السديس","Abdurrahmaan_As-Sudais_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Abdurrahmaan_As-Sudais_64kbps","",""),
"16"=>array("سعود الشريم","Saood_ash-Shuraym_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Saood_ash-Shuraym_64kbps","",""),
"17"=>array("أحمد العجمى ","Ibrahim_Akhdar_32kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Ahmed_ibn_Ali_al-Ajamy_64kbps","",""),
"18"=>array("مشارى العفاسى","Alafasy_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Alafasy_64kbps","",""),
"19"=>array("محمد جبريل","Muhammad_Jibreel_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Muhammad_Jibreel_64kbps","",""),
"20"=>array("هانى الرفاعى","Hani_Rifai_192kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Hani_Rifai_192kbps","",""),
"21"=>array("أبو بكر الشاطرى","Abu_Bakr_Ash-Shaatree_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/Abu_Bakr_Ash-Shaatree_64kbps","",""),
"22"=>array("ياسين الجزائري (ورش)","warsh_yassin_64kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/warsh_yassin_64kbps","",""),
"23"=>array("إبراهيم الدوسري (ورش)","warsh_dossary_128kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/warsh_dossary_128kbps","",""),
"24"=>array("خليفة الطنيجي","tunaiji_128kbps","http://cdn.ksu.edu.sa/quran/ayat/mp3/tunaiji_128kbps","",""));
##############
$readers_ayat = array(
"1"=>array("عبدالباسط عبدالصمد","Abdelbaset Abdulsama","http://www.everyayah.com/data/Abdul_Basit_Murattal_192kbps","مصحف مرتل","Murattal_192kbps"),
"2"=>array("عبدالباسط عبدالصمد","Abdelbaset Abdulsama","http://www.everyayah.com/data/Abdul_Basit_Mujawwad_128kbps","مصحف مجود","Mujawwad_128kbps"),
"3"=>array("عبدالله بصفر","Abdullah Basfer","http://www.everyayah.com/data/Abdullah_Basfar_32kbps","الجوده 32 كيلوبايت","32kbps"),
"4"=>array("عبدالله بصفر","Abdullah Basfer","http://www.everyayah.com/data/Abdullah_Basfar_192kbps","جودة 192 كيلوبايت","192kbps"),
"5"=>array("عبدالرحمن السديس","Abdelrahman Alsodis","http://www.everyayah.com/data/Abdurrahmaan_As-Sudais_192kbps","","192kbps"),
"6"=>array("عبدالباسط عبدالصمد","Abdelbaset Abdulsama","http://www.everyayah.com/data/AbdulSamad_64kbps_QuranExplorer.Com","جوده 64 كيلوبايت","64kbps_QuranExplorer.Com"),
"7"=>array("ابوبكر الشاطري","Abobaker Alshatri","http://www.everyayah.com/data/Abu%20Bakr%20Ash-Shaatree_128kbps","","128kbps"),
"8"=>array("احمد العجمي","Ahmad Alajmi","http://www.everyayah.com/data/Ahmed_ibn_Ali_al-Ajamy_64kbps_QuranExplorer.Com","جودة 64 كيلوبايت","64kbps_QuranExplorer.Com"),
"9"=>array("احمد العجمي","Ahmad Alajmi","http://www.everyayah.com/data/Ahmed_ibn_Ali_al-Ajamy_128kbps_ketaballah.net","جوده 128 كيلوبايت","128kbps_ketaballah.net"),
"10"=>array("مشاري العفاسي","Mshari Alefas","http://www.everyayah.com/data/Alafasy_128kbps","","128kbps"),
"11"=>array("سعد الغامدي","Saad Aljamedi","http://www.everyayah.com/data/Ghamadi_40kbps","","40kbps"),
"12"=>array("هاني الرفاعي","Hani Alrefae","http://www.everyayah.com/data/Hani_Rifai_192kbps","","192kbps"),
"13"=>array("محمود خليل الحصري","Mahmoud Khalil Alhosari","http://www.everyayah.com/data/Husary_128kbps_Mujawwad","المصحف المجود","128kbps_Mujawwad"),
"14"=>array("علي الحذيفي","Ali Alhudifi","http://www.everyayah.com/data/Hudhaify_32kbps","جودة 32 كيلوبايت","32kbps"),
"15"=>array("علي الحذيفي","Ali Alhudifi","http://www.everyayah.com/data/Hudhaify_128kbps","جودة 128 كيلوبايت","128kbps"),
"16"=>array("ابراهيم الاخضر","Ibrahem Alakhdar","http://www.everyayah.com/data/Ibrahim_Akhdar_32kbps","","32kbps"),
"17"=>array("محمد صديق المنشاوي","Mohammed seddeq Almenshawi","http://www.everyayah.com/data/Menshawi_16kbps","","16kbps"),
"18"=>array("محمد صديق المنشاوي","Mohammed seddeq Almenshawi","http://www.everyayah.com/data/Minshawy_Mujawwad_192kbps","المصحف المجود","Mujawwad"),
"19"=>array("محمد صديق المشاوي","Mohammed seddeq Almenshawi","http://www.everyayah.com/data/Minshawy_Murattal_128kbps","المصحف المرتل","Murattal"),
"20"=>array("محمد الطبلاوي","Mohammed Altablawi","http://www.everyayah.com/data/Mohammad_al_Tablaway_128kbps","","128kbps"),
"21"=>array("محمد أيوب","Mohammed Ayoub","http://www.everyayah.com/data/Muhammad_Ayyoub_128kbps","","128kbps"),
"22"=>array("محمد جبريل","Mohammed Jebrel","http://www.everyayah.com/data/Muhammad_Jibreel_128kbps","","128kbps"),
"23"=>array("سعود الشريم","Saoud Alshorim","http://www.everyayah.com/data/Saood%20bin%20Ibraaheem%20Ash-Shuraym_128kbps","","128kbps"),
"24"=>array("مشاري العفاسي","Mshari Alefasi","http://www.quran-for-all.com/sound/versebyverse/alafasy/","من الموقع www.quran-for-all.com","From www.quran-for-all.com")
);
//http://quranicresearcher.com/sounds/VerseByVerse/


?>
