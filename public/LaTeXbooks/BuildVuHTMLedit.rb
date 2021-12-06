require "fileutils"

directories = []

Dir.chdir('/Users/tomixy/myWorkSpace/PHP/Laravel/TetraCalibersCMS/public/LaTeXbooks') do
    Dir.glob("./*") do |f|
        if FileTest.directory?(f)
            directories.push(f.delete('./'))
        end
    end
    directories.each do |directory|
        File.open("#{directory}/Re_index.html", 'rt') do |index_html|
            $stdout = File.open("#{directory}/index.html", 'w')

            index_html.each_line do |line|
                load_asset = line[/assets\/idrviewer\./]
                load_config = line[/config.js/]
                if load_asset
                    puts line.gsub!(load_asset, "/LaTeXbooks/#{directory}/assets/idrviewer.")
                elsif load_config
                    puts line.gsub!(load_config, "/LaTeXbooks/#{directory}/config.js")
                else
                    puts line
                end
            end
        end
    end
end
