require "fileutils"

targetDir = "combinatorics"

Dir.chdir("/Users/tomixy/myWorkSpace/PHP/Laravel/TetraCalibersCMS/public/LaTeXbooks/#{targetDir}/assets") do
    `cp ../../idrviewer.sample.js idrviewer.js`
end

Dir.chdir("/Users/tomixy/myWorkSpace/PHP/Laravel/TetraCalibersCMS/public/LaTeXbooks/#{targetDir}") do
    if File.exist?("inddex.html")
        File.delete("index.html")
    end
end

Dir.chdir("/Users/tomixy/myWorkSpace/PHP/Laravel/TetraCalibersCMS/public/LaTeXbooks/#{targetDir}/assets") do
    $stdout = File.open("idrviewer.annotations.txt", 'w')
    File.open("idrviewer.annotations.js", 'rt') do |f|
        f.each_line do |line|
            line.gsub!("var baseUrl = data.url || \"\";", "var baseUrl = \"/LaTeXbooks/#{targetDir}/\"")
            line.gsub!("request.open('GET', 'annotations.json', true);", "request.open('GET', '/LaTeXbooks/#{targetDir}/annotations.json', true);")
            puts line
        end
    end
    `cp idrviewer.annotations.txt idrviewer.annotations.js`
    File.delete("idrviewer.annotations.txt")

    $stdout = File.open("idrviewer.search.txt", 'w')
    File.open("idrviewer.search.js", 'rt') do |f|
        f.each_line do |line|
            line.gsub!("baseUrl = data.url || \"\";", "baseUrl = \"/LaTeXbooks/#{targetDir}/\"")
            puts line
        end
    end
    `cp idrviewer.search.txt idrviewer.search.js`
    File.delete("idrviewer.search.txt")

    $stdout = File.open("idrviewer.txt", 'w')
    File.open("idrviewer.js", 'rt') do |f|
        f.each_line do |line|
            line.gsub!("URL = \"\";", "URL = '/LaTeXbooks/#{targetDir}/';")
            puts line
        end
    end
    `cp idrviewer.txt idrviewer.js`
    File.delete("idrviewer.txt")
end
