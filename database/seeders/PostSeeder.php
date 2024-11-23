<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'post_catalogue_children_id' => 2, 
                'post_catalogue_parent_id' => 1, 
                'post_name' => 'Người đàn ông bị lật đò, bám vào cột đèn suốt 12 tiếng', 
                'post_excerpt' => '<p>Quảng B&igrave;nhTrong l&uacute;c đi mua xăng, &ocirc;ng Trương Văn Duy ở huyện Lệ Thủy bị nước lũ l&agrave;m lật đ&ograve;, phải b&aacute;m v&agrave;o cột đ&egrave;n đường suốt 12 tiếng.</p>', 
                'post_content' => '<p>Khoảng 17h30 h&ocirc;m qua, &ocirc;ng Duy, 58 tuổi, tr&uacute; x&atilde; Xu&acirc;n Thủy, huyện Lệ Thủy, ch&egrave;o đ&ograve; gỗ qua đoạn đường ngập tr&ecirc;n c&aacute;nh đồng để đi mua xăng. Mưa to, s&oacute;ng lớn đ&atilde; đ&aacute;nh lật đ&ograve;, hất &ocirc;ng Duy xuống nước.</p>

<p>Sau khi tr&ocirc;i tự do một đoạn, &ocirc;ng Duy cố hết sức bơi đến cột đ&egrave;n đường, tr&egrave;o l&ecirc;n nắm chặt v&agrave;o khung sắt của biển quảng c&aacute;o. Do kh&ocirc;ng c&oacute; điện thoại để li&ecirc;n lạc với người th&acirc;n, &ocirc;ng Duy đ&agrave;nh b&aacute;m v&agrave;o cột đ&egrave;n chờ nước r&uacute;t.</p>

<p>&Ocirc;ng Duy chia sẻ bản th&acirc;n biết bơi, l&uacute;c rơi xuống mặc &aacute;o phao n&ecirc;n may mắn tho&aacute;t nạn. Biển nước m&ecirc;nh m&ocirc;ng, s&acirc;u khoảng hai m&eacute;t n&ecirc;n &ocirc;ng kh&ocirc;ng thể tự bơi về nh&agrave;. Suốt đ&ecirc;m b&aacute;m cột đ&egrave;n giữa trời mưa to, &ocirc;ng bị lạnh, tay ch&acirc;n t&iacute;m t&aacute;i.</p>

<p>Sau khi được ăn uống, l&agrave;m ấm, &ocirc;ng Duy đ&atilde; khỏe, đang chờ người nh&agrave; đến đ&oacute;n.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Ông Duy thất thần sau khi được cứu. Ảnh: Hùng Lê" data-ll-status="loaded" data-src="https://i1-vnexpress.vnecdn.net/2024/10/29/ong-duy-that-than-8329-1730178648.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=mtNMHqt-CJQxirq1AGElLw" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-vnexpress.vnecdn.net/2024/10/29/ong-duy-that-than-8329-1730178648.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=mtNMHqt-CJQxirq1AGElLw" />
<figcaption itemprop="description">
<p>&Ocirc;ng Duy thất thần sau khi được cứu. Ảnh:<em>&nbsp;H&ugrave;ng L&ecirc;</em></p>
</figcaption>
</figure>

<p>Ảnh hưởng b&atilde;o Tr&agrave; Mi v&agrave; kh&ocirc;ng kh&iacute; lạnh, tỉnh Quảng B&igrave;nh mưa to li&ecirc;n tục ba ng&agrave;y qua. Lũ s&ocirc;ng Kiến Giang tại Lệ Thủy đ&atilde; vượt b&aacute;o động ba hơn một m&eacute;t.</p>

<p>32.000 hộ d&acirc;n đ&atilde; bị ngập 1,5-2,5 m, tập trung tại huyện Quảng Ninh, Lệ Thủy. 58 th&ocirc;n, bản bị nước lũ chia cắt. Một người chết do lũ cuốn, hai người mất t&iacute;ch do lật thuyền ở huyện Lệ Thủy v&agrave; huyện Quảng Ninh.</p>', 
                'user_id' => 3, 
                'image' => '/userfiles/image/Danh%20m%E1%BB%A5c%20cha/Th%E1%BB%9Di%20s%E1%BB%B1/thumb-1280x720-241.jpg', 
                'publish' => '2', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(),
            ],
            [
                'post_catalogue_children_id' => 1,
                'post_catalogue_parent_id' => 3, 
                'post_name' => 'Cuộc vận động của ông Trump có thể tạo đà cho bà Harris', 
                'post_excerpt' => '<p>Những ph&aacute;t biểu ph&acirc;n biệt chủng tộc của diễn vi&ecirc;n h&agrave;i trong cuộc vận động tại New York khiến phe Cộng h&ograve;a lo ngại &ocirc;ng Trump đang tạo cơ hội cho b&agrave; Harris.</p>', 
                'post_content' => '<p>Diễn vi&ecirc;n h&agrave;i Tony Hinchcliffe, 40 tuổi, tối 27/10 được mời tới diễn thuyết trước đ&aacute;m đ&ocirc;ng tại hội trường Madison Square Garden ở th&agrave;nh phố New York, khi ứng vi&ecirc;n tổng thống đảng Cộng h&ograve;a Donald Trump tổ chức cuộc vận động tranh cử tại đ&acirc;y.</p>

<p>Tuy nhi&ecirc;n, b&agrave;i ph&aacute;t biểu của Hinchcliffe đ&atilde; khiến ch&iacute;nh c&aacute;c th&agrave;nh vi&ecirc;n cốt c&aacute;n của đảng Cộng h&ograve;a thất vọng, khi diễn vi&ecirc;n n&agrave;y tung ra những lời lẽ mang t&iacute;nh ph&acirc;n biệt chủng tộc, tục tĩu v&agrave; g&acirc;y chia rẽ. Shermichael Singleton, chiến lược gia của đảng Cộng h&ograve;a, cho rằng cuộc vận động n&agrave;y của Trump đ&atilde; trao &quot;cơ hội mới&quot; để b&agrave; Kamala Harris thắng ở Pennsylvania, bang chiến trường rất quan trọng với cả hai ứng vi&ecirc;n.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Diễn viên hài Tony Hinchcliffe, 40 tuổi, tại Madison Square Garden ở thành phố New York tối 27/10. Ảnh: AP" data-ll-status="loaded" data-src="https://i1-vnexpress.vnecdn.net/2024/10/29/AP24301690101673-8925-1730175530.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=0j_z-sHsFa0AoLNPupJFmw" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-vnexpress.vnecdn.net/2024/10/29/AP24301690101673-8925-1730175530.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=0j_z-sHsFa0AoLNPupJFmw" />
<figcaption itemprop="description">
<p>Diễn vi&ecirc;n h&agrave;i Tony Hinchcliffe ph&aacute;t biểu tại Madison Square Garden ở th&agrave;nh phố New York tối 27/10. Ảnh:&nbsp;<em>AP</em></p>
</figcaption>
</figure>

<p>Tr&ecirc;n s&acirc;n khấu ở Madison Square Garden, Hinchcliffee tuy&ecirc;n bố Puerto Rico l&agrave; &quot;h&ograve;n đảo đầy r&aacute;c rưởi tr&ocirc;i nổi giữa đại dương&quot;, đồng thời đưa ra những lời lẽ khiếm nh&atilde; về người da đen v&agrave; người gốc Latin.</p>

<p>Diễn vi&ecirc;n n&agrave;y đ&ugrave;a rằng người Mỹ gốc Latin th&iacute;ch &quot;tạo ra em b&eacute;&quot;, rồi pha tr&ograve; về việc c&ugrave;ng một người bạn da đen &quot;ngồi khắc dưa hấu&quot; cho lễ hội Halloween.</p>

<p>&quot;T&ocirc;i ch&agrave;o đ&oacute;n người nhập cư tới Mỹ với v&ograve;ng tay rộng mở&quot;, Hinchcliffee n&oacute;i, giang rộng hai tay. &quot;V&agrave; khi l&agrave;m vậy, &yacute; của t&ocirc;i l&agrave;: Đừng, h&atilde;y c&uacute;t đi&quot;.</p>

<p>L&agrave;n s&oacute;ng chỉ tr&iacute;ch v&agrave; giận dữ với b&igrave;nh luận của Hinchcliffee lan rộng tới mức đội ngũ vận động tranh cử của &ocirc;ng Trump phải nhanh ch&oacute;ng tuy&ecirc;n bố đ&acirc;y chỉ l&agrave; lời n&oacute;i đ&ugrave;a của nam diễn vi&ecirc;n, kh&ocirc;ng phản &aacute;nh quan điểm của &ocirc;ng Trump hay chiến dịch.</p>

<p>Nhiều th&agrave;nh vi&ecirc;n đảng vi&ecirc;n Cộng h&ograve;a đ&atilde; l&ecirc;n &aacute;n ph&aacute;t ng&ocirc;n của Hinchcliffee, cho rằng sự kiện n&agrave;y c&oacute; thể ảnh hưởng xấu tới &ocirc;ng Trump ở một số bang chiến trường quan trọng, nơi cử tri gốc Puerto Rico c&oacute; thể lật ngược t&igrave;nh thế giữa &ocirc;ng Trump v&agrave; b&agrave; Harris.</p>

<p>Singleton, người từng l&agrave;m việc trong chiến dịch tranh cử tổng thống của c&aacute;c ứng vi&ecirc;n Cộng h&ograve;a như Newt Gingrich, Mitt Romney v&agrave; Ben Carson, nhận định lời lẽ của Hinchcliffee c&oacute; thể gi&aacute;ng đ&ograve;n mạnh tới sự ủng hộ của cử tri Pennsylvania d&agrave;nh cho &ocirc;ng Trump, d&ugrave; cựu tổng thống c&oacute; t&igrave;m c&aacute;ch giải th&iacute;ch thế n&agrave;o đi chăng nữa.</p>

<p>Theo Singleton, Pennsylvania l&agrave; bang chiến trường quan trọng, nơi c&oacute; hơn 465.000 cử tri gốc Puerto Rico, chiếm 3,69% d&acirc;n số, v&agrave; chiến dịch của b&agrave; Harris trước đ&acirc;y phải rất vất vả để t&igrave;m c&aacute;ch l&ocirc;i k&eacute;o cử tri.</p>

<p>&quot;Giờ đ&acirc;y, nh&oacute;m &ocirc;ng Trump đ&atilde; trao cho b&agrave; Harris cơ hội hướng tới nh&oacute;m cử tri n&agrave;y bằng c&aacute;ch chạy quảng c&aacute;o tiếng Anh v&agrave; tiếng T&acirc;y Ban Nha, g&otilde; cửa từng nh&agrave;, tập trung v&agrave;o cộng đồng người Puerto Rico đ&ocirc;ng đ&uacute;c&quot;, &ocirc;ng n&oacute;i tiếp. &quot;Ngay cả khi tỷ lệ cử tri gốc Puerto Rico đi bỏ phiếu tăng th&ecirc;m chỉ 1-2%, họ cũng đủ để gi&uacute;p Harris thắng ở bang n&agrave;y&quot;.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Ông Trump vận động tranh cử tại Madison Square Garden ở thành phố New York tối 27/10. Ảnh: AP" data-ll-status="loaded" data-src="https://i1-vnexpress.vnecdn.net/2024/10/29/AP24302026291649-9035-1730175530.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=EWDMvbDZReuLHTQJGPnzMw" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-vnexpress.vnecdn.net/2024/10/29/AP24302026291649-9035-1730175530.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=EWDMvbDZReuLHTQJGPnzMw" />
<figcaption itemprop="description">
<p>&Ocirc;ng Trump vận động tranh cử tại Madison Square Garden ở th&agrave;nh phố New York tối 27/10. Ảnh:&nbsp;<em>AP</em></p>
</figcaption>
</figure>

<p>Chiến dịch của b&agrave; Harris lập tức tận dụng ph&aacute;t ng&ocirc;n của Hinchcliffe, chia sẻ những c&acirc;u n&oacute;i của nam diễn vi&ecirc;n về Puerto Rico tr&ecirc;n mạng x&atilde; hội. Ph&oacute; tổng thống Mỹ ng&agrave;y 27/10 đăng video chỉ tr&iacute;ch c&aacute;c ch&iacute;nh s&aacute;ch của &ocirc;ng Trump với Puerto Rico v&agrave; c&ocirc;ng bố kế hoạch chi tiết về ch&iacute;nh s&aacute;ch th&uacute;c đẩy kinh tế quốc gia n&agrave;y nếu đắc cử v&agrave;o th&aacute;ng 11.</p>

<p>Một số người Puerto Rico nổi tiếng đ&atilde; l&ecirc;n tiếng ủng hộ b&agrave; Harris sau ph&aacute;t biểu của Hinchcliffe. Bad Bunny, người c&oacute; 45,6 triệu người theo d&otilde;i tr&ecirc;n Instagram, 4 lần chia sẻ video của b&agrave; Harris tr&ecirc;n mạng x&atilde; hội.</p>

<p>Nhạc sĩ ki&ecirc;m diễn vi&ecirc;n Ricky Martin, người c&oacute; hơn 18,6 triệu người theo d&otilde;i tr&ecirc;n Instagram, đăng clip những c&acirc;u n&oacute;i đ&ugrave;a của Hinchcliffe l&ecirc;n t&agrave;i khoản k&egrave;m b&igrave;nh luận bằng tiếng T&acirc;y Ban Nha: &quot;Đ&acirc;y l&agrave; những g&igrave; họ nghĩ về ch&uacute;ng ta. H&atilde;y bỏ phiếu cho Kamala Harris&quot;.</p>

<p>Shanahan, gi&aacute;o sư m&ocirc;n ch&iacute;nh trị Đại học Surrey ở Anh, cho rằng ph&aacute;t ng&ocirc;n của Hinchcliffe c&oacute; thể l&agrave; &quot;c&aacute;ch vận động g&acirc;y ảnh hưởng nghi&ecirc;m trọng nhất đến &ocirc;ng Trump trong tuần n&agrave;y&quot;.</p>

<p>&quot;Nếu Hinchcliffe g&acirc;y bức x&uacute;c đủ để khiến cử tri xa rời &ocirc;ng Trump, đ&acirc;y c&oacute; thể l&agrave; tr&ograve; đ&ugrave;a chấm dứt sự nghiệp của &ocirc;ng ta, cũng như chấm dứt hy vọng quay lại Nh&agrave; Trắng của Trump&quot;, Shanahan n&oacute;i.</p>

<p>Theo kết quả thăm d&ograve; của&nbsp;<em>FiveThirtyEight</em>, t&iacute;nh đến tối 28/10, &ocirc;ng Trump đang dẫn trước 0,3% tại bang Pennsylvania, gần như ngang bằng vị thế với b&agrave; Harris. Kết quả thăm d&ograve; của&nbsp;<em>New York Times</em>&nbsp;cũng cho thấy hai người ngang nhau với 48% ủng hộ ở Pennsylvania t&iacute;nh đến 28/10, nhưng c&aacute;c khảo s&aacute;t được tiến h&agrave;nh trước cuộc vận động của Trump ở New York.</p>

<p>Theo kết quả khảo s&aacute;t to&agrave;n quốc của&nbsp;<em>ABC News/Ipsos</em>&nbsp;được c&ocirc;ng bố h&ocirc;m 27/10, b&agrave; Harris gi&agrave;nh được 51% ủng hộ, cao hơn &ocirc;ng Trump 4 điểm phần trăm, khi cuộc bầu cử sẽ diễn ra trong một tuần nữa.</p>', 
                'user_id' => 3, 
                'image' => '/userfiles/image/Danh%20m%E1%BB%A5c%20cha/Th%E1%BA%BF%20gi%E1%BB%9Bi/TT.jpg', 
                'publish' => '2', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(),
            ],
            [
                'post_catalogue_children_id' => 1, 
                'post_catalogue_parent_id' => 5, 
                'post_name' => 'Chung cư 1-3 tỷ đồng dần biến mất thế nào', 
                'post_excerpt' => '<p>10 năm trước, với một tỷ c&oacute; thể chọn nhiều chung cư mới nhưng giờ chỉ đủ mua nửa căn studio v&agrave; ngay đến 3 tỷ đồng cũng kh&ocirc;ng dễ mua nh&agrave;.</p>', 
                'post_content' => '<p>C&aacute;ch đ&acirc;y hơn chục năm, gia đ&igrave;nh chị Minh Anh mua một căn hộ mới 2 ph&ograve;ng ngủ, diện t&iacute;ch 75 m2 tại một dự &aacute;n nằm tr&ecirc;n đường Ph&uacute;c Xa, khu đ&ocirc; thị Xa La, H&agrave; Đ&ocirc;ng. Gi&aacute; khi đ&oacute; l&agrave; 970 triệu đồng, tức khoảng 13 triệu đồng một m2.</p>

<p>Giai đoạn đ&oacute;, với t&agrave;i ch&iacute;nh tr&ecirc;n dưới 1 tỷ đồng, người mua chung cư c&oacute; kh&aacute; nhiều lựa chọn căn hộ rộng tối thiểu 60 m2 với loạt dự &aacute;n ở Ho&agrave;i Đức, H&agrave; Đ&ocirc;ng như Văn Ph&uacute;, S&ocirc;ng Nhuệ, The Spark, Xu&acirc;n Mai Tower, Xa La hay ở Ho&agrave;ng Mai như Kim Văn Kim Lũ, HH Linh Đ&agrave;m.</p>

<p>Đ&acirc;y cũng được coi l&agrave; thời kỳ ho&agrave;ng kim của căn hộ b&igrave;nh d&acirc;n (hay c&ograve;n gọi l&agrave; nh&agrave; gi&aacute; rẻ, vừa t&uacute;i tiền). Bởi theo CBRE Việt Nam, năm 2014, căn hộ dưới 35 triệu đồng đứng đầu nguồn cung mới ra thị trường, chiếm xấp xỉ 40%.</p>

<p>Thậm ch&iacute; đến năm 2016, nh&agrave; gi&aacute; rẻ vẫn tạo n&ecirc;n cơn sốt thanh khoản ở cả H&agrave; Nội v&agrave; TP HCM. Khi đ&oacute;, tại một số dự &aacute;n ở H&agrave; Nội, do nhu cầu của người mua qu&aacute; lớn, chủ đầu tư c&ograve;n phải tổ chức bốc thăm hay ch&ecirc;nh gi&aacute; h&agrave;ng chục triệu sau mỗi đợt tung h&agrave;ng mới ra thị trường.</p>

<p>&nbsp;</p>

<p><iframe data-src="https://flo.uri.sh/visualisation/19914869/embed" frameborder="0" height="500" scrolling="no" src="https://flo.uri.sh/visualisation/19914869/embed" width="100%"></iframe></p>

<p>Tuy nhi&ecirc;n, hiện tại, số tiền 1 tỷ đồng c&oacute; thể chỉ đủ để sở hữu một nửa diện t&iacute;ch căn hộ dạng studio (rộng 28 - 32 m2) tại c&aacute;c dự &aacute;n mới. Theo khảo s&aacute;t của&nbsp;<em>VnExpress&nbsp;</em>tại một khu đ&ocirc; thị ph&iacute;a T&acirc;y nằm ngo&agrave;i v&agrave;nh đai 3, c&aacute;c căn dạng n&agrave;y đang được ch&agrave;o b&aacute;n tr&ecirc;n thị trường sơ cấp 1,6-2 tỷ đồng, c&ograve;n chung cư 1 ph&ograve;ng ngủ +1 (diện t&iacute;ch 43-48 m2) c&oacute; gi&aacute; thấp nhất cũng từ 2,4-2,5 tỷ đồng.</p>

<p>Thực tế, nguồn cung căn hộ với gi&aacute; quanh mức 1 tỷ đồng tại H&agrave; Nội đ&atilde; c&oacute; dấu hiệu suy giảm trong giai đoạn 2018-2020. Từ năm 2020 đến nay, thủ đ&ocirc; gần như &quot;tuyệt chủng&quot; chung cư thương mại gi&aacute; rẻ.</p>

<p>Năm đ&oacute;, nguồn cung căn hộ mới ở đột ngột giảm một nửa so với 2 năm trước, xuống mức dưới 18.000 căn, trong đ&oacute; nh&agrave; trung cấp (35-60 triệu đồng một m2) lại c&oacute; đến hơn 13.000 căn. Đ&acirc;y cũng ch&iacute;nh l&agrave; thời điểm mở đầu cho giai đoạn c&aacute;c doanh nghiệp kh&ocirc;ng c&ograve;n mặn m&agrave; với việc ph&aacute;t triển nh&agrave; b&igrave;nh d&acirc;n v&agrave; dần bước v&agrave;o cuộc đua thiết lập mặt bằng gi&aacute; mới.</p>

<p>T&igrave;nh trạng n&agrave;y xuất hiện từ nhiều nguy&ecirc;n nh&acirc;n như gi&aacute; đất, chi ph&iacute; x&acirc;y dựng tăng, k&eacute;o gi&aacute; b&aacute;n đi l&ecirc;n. V&agrave; quan trọng nhất l&agrave; nhiều dự &aacute;n gặp vướng mắc ph&aacute;p l&yacute; k&eacute;o d&agrave;i, l&agrave;m nguồn cung ng&agrave;y c&agrave;ng khan hiếm, khiến gi&aacute; nh&agrave; tăng tại c&aacute;c dự &aacute;n mới.</p>

<p>Tiếp sau nh&agrave; gi&aacute; rẻ, đến đầu năm 2022, căn hộ 2 ph&ograve;ng ngủ với gi&aacute; khoảng 2 tỷ đồng<strong>&nbsp;</strong>cũng bắt đầu khan hiếm v&agrave; biến mất cả ở khu vực huyện ven H&agrave; Nội v&agrave;o năm 2023. Thời điểm đ&oacute;, thị trường sơ cấp thiết lập mặt bằng gi&aacute; b&igrave;nh qu&acirc;n 46 triệu đồng mỗi m2. Tương ứng một căn hộ rộng 60 m2 cũng phải c&oacute; gi&aacute; từ gần 2,8 tỷ đồng.</p>

<p>D&ugrave; căn hộ mới tầm tiền n&agrave;y đ&atilde; biến mất từ 2 năm trước, đến nay, n&oacute; vẫn l&agrave; loại h&igrave;nh phần đ&ocirc;ng người d&acirc;n c&oacute; thể đ&aacute;p ứng nhu cầu t&agrave;i ch&iacute;nh. Theo một khảo s&aacute;t gần đ&acirc;y của&nbsp;<em>VnExpress</em>, hơn một nửa trong số 3.100 người tham gia trả lời rằng chỉ c&oacute; khả năng mua nh&agrave; dưới 2 tỷ đồng.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Chung cư giá rẻ biến mất thế nào một thập kỷ qua - 1" data-ll-status="loaded" data-src="https://i1-vnexpress.vnecdn.net/2024/10/29/A-nh-ma-n-hi-nh-2024-10-29-lu-4656-1974-1730138387.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=Zdc1BPVKyc-avpSvReua6A" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-vnexpress.vnecdn.net/2024/10/29/A-nh-ma-n-hi-nh-2024-10-29-lu-4656-1974-1730138387.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=Zdc1BPVKyc-avpSvReua6A" />
<figcaption itemprop="description">&nbsp;</figcaption>
</figure>

<p>T&igrave;nh trạng lệch pha tr&ecirc;n thị trường căn hộ ng&agrave;y c&agrave;ng trầm trọng hơn khi 9 th&aacute;ng đầu năm nay, nh&agrave; cao cấp (gi&aacute; 60-120 triệu đồng một m2) phủ s&oacute;ng gần 70% tổng nguồn cung tr&ecirc;n thị trường. Từ cuối qu&yacute; II năm nay, sau cơn sốt chung cư, gi&aacute; căn hộ mới dưới 50 triệu đồng một m2 gần như vắng b&oacute;ng tại H&agrave; Nội. Đơn gi&aacute; n&agrave;y hiện chỉ tồn tại c&aacute;c dự ở v&ugrave;ng l&acirc;n cận như Hưng Y&ecirc;n, Bắc Ninh, H&agrave; Nam.</p>

<p>Điều n&agrave;y khiến việc<strong>&nbsp;</strong>mua chung cư mới, 2 ph&ograve;ng ngủ với gi&aacute; 3 tỷ đồng hiện nay cũng bất khả thi. Thậm ch&iacute; số tiền n&agrave;y c&ograve;n kh&ocirc;ng đủ sở hữu căn studio tại một dự &aacute;n vừa được ra mắt tại huyện Đ&ocirc;ng Anh. Chủ đầu tư dự &aacute;n n&agrave;y c&ocirc;ng bố mức gi&aacute; thăm d&ograve; cho c&aacute;c căn hộ studio (diện t&iacute;ch 30,5-31 m2) từ 3,26 tỷ đến 3,68 tỷ đồng</p>

<p>Với 3 tỷ đồng, người d&acirc;n hiện chỉ c&oacute; thể mua căn hộ mới dạng 1 ph&ograve;ng ngủ + 1 hoặc studio trong c&aacute;c đại đ&ocirc; thị ph&iacute;a T&acirc;y, ph&iacute;a Đ&ocirc;ng hoặc căn hộ cũ tại một số huyện ven H&agrave; Nội.</p>

<p>Như vậy, chỉ trong hơn 4 năm, c&aacute;c loại căn hộ ph&ugrave; hợp với t&uacute;i tiền của người d&acirc;n như 1 tỷ, 2 tỷ v&agrave; cả 3 tỷ đồng đ&atilde; lần lượt biến mất. Diễn biến n&agrave;y cũng tr&ugrave;ng khớp với đ&agrave; tăng gi&aacute; mạnh mẽ của thị trường căn hộ H&agrave; Nội từ 2020 đến nay.</p>

<p>&nbsp;</p>

<p><iframe data-src="https://flo.uri.sh/visualisation/19914232/embed" frameborder="0" height="700" scrolling="no" src="https://flo.uri.sh/visualisation/19914232/embed" width="100%"></iframe></p>

<p>Theo dữ liệu của CBRE, đến hết qu&yacute; III, b&igrave;nh qu&acirc;n gi&aacute; b&aacute;n căn hộ sơ cấp (chưa gồm VAT, ph&iacute; bảo tr&igrave;) đ&atilde; đạt đến 64 triệu đồng một m2, tăng 3 lần so với 10 năm trước. Tuy nhi&ecirc;n, gi&aacute; sản phẩm n&agrave;y chỉ thực sự biến động mạnh từ năm 2020, với bi&ecirc;n độ tăng gần 100%. So với TP HCM, mức tăng trong giai đoạn n&agrave;y của H&agrave; Nội gấp 4 lần.</p>

<p>B&agrave; Nguyễn Ho&agrave;i An, Gi&aacute;m đốc cao cấp CBRE H&agrave; Nội cho biết b&igrave;nh qu&acirc;n gi&aacute; căn hộ sơ cấp H&agrave; Nội giai đoạn 2014-2019 b&igrave;nh qu&acirc;n tăng 8% mỗi năm. Giai đoạn 2019-2024, mức tăng gấp đ&ocirc;i l&ecirc;n 16% một năm. Theo b&agrave;, gi&aacute; căn hộ tăng mạnh chỉ trong một thời gian ngắn bởi nhiều l&yacute; do, trong đ&oacute;, chung cư trở n&ecirc;n quen thuộc hơn với người d&acirc;n ở H&agrave; Nội. Đồng thời, thị trường nh&agrave; ở cũng c&oacute; th&ecirc;m sự tham gia c&aacute;c doanh nghiệp c&oacute; tiềm lực, chủ đầu tư nước ngo&agrave;i gi&uacute;p thị trường ph&aacute;t triển hơn. Ngo&agrave;i ra, c&aacute;c dự &aacute;n mới ra mắt từ đầu năm đến cũng đều nằm trong c&aacute;c đại đ&ocirc; thị đ&atilde; c&oacute; sẵn mặt gi&aacute; cao.</p>

<p>&nbsp;</p>

<p><iframe data-src="https://flo.uri.sh/visualisation/19913749/embed" frameborder="0" height="500" scrolling="no" src="https://flo.uri.sh/visualisation/19913749/embed" width="100%"></iframe></p>

<p>Tương tự, Hội m&ocirc;i giới Bất động sản Việt Nam (VARS) cũng đ&aacute;nh gi&aacute; định kiến đầu tư chung cư l&agrave; ti&ecirc;u sản đ&atilde; được ph&aacute; bỏ nhờ gi&aacute; mua b&aacute;n tăng kh&ocirc;ng ngừng. Trong bối cảnh c&aacute;c sản phẩm như bất động sản nghỉ dưỡng đổ vỡ, đất nền nhiều nơi &quot;đứng b&aacute;nh&quot;, chung cư lại c&oacute; thể tạo ra d&ograve;ng tiền cho thu&ecirc; đều đặn h&agrave;ng th&aacute;ng với mức cao hơn gửi tiết kiệm, tiềm năng tăng gi&aacute;</p>

<p>B&agrave; Phạm Thị Miền, Đại diện VARS cho rằng ph&acirc;n kh&uacute;c căn hộ vừa qua cũng đ&atilde; dẫn dắt thị trường khi li&ecirc;n tục thiết lập mặt bằng gi&aacute; mới với cả thị trường sơ cấp v&agrave; thứ cấp. Gần đ&acirc;y, c&aacute;c dự &aacute;n căn hộ c&oacute; mức gi&aacute; đến 80-90 triệu đồng một m2 nhưng vẫn b&aacute;n chạy.</p>

<p>C&ograve;n theo l&atilde;nh đạo một c&ocirc;ng ty chuy&ecirc;n tư vấn ph&aacute;t triển dự &aacute;n ở ph&iacute;a Bắc, cuộc chơi tr&ecirc;n thị trường nh&agrave; ở 10 năm trước c&oacute; đa dạng chủ đầu tư hơn, trong đ&oacute; nhiều dự &aacute;n nh&agrave; gi&aacute; rẻ, vừa t&uacute;i tiền đến từ c&aacute;c c&ocirc;ng ty c&oacute; vốn đầu tư nh&agrave; nước hay doanh nghiệp tầm trung, thậm c&oacute; cả doanh nghiệp tr&aacute;i ng&agrave;nh.</p>

<p>Trong khi đ&oacute;, những năm gần đ&acirc;y thị trường gần như chỉ đ&oacute;n th&ecirc;m dự &aacute;n từ v&agrave;i chủ đầu tư c&oacute; tiềm lực v&agrave; cũng định vị ở ph&acirc;n kh&uacute;c sản phẩm cao. Doanh nghiệp nước ngo&agrave;i tham gia thị trường cũng phải th&ocirc;ng qua M&amp;A quỹ đất, đội th&ecirc;m chi ph&iacute; n&ecirc;n kh&ocirc;ng thể thiết lập gi&aacute; sản phẩm ở mức thấp nhằm đảm bảo bi&ecirc;n lợi nhuận.</p>

<p>T&igrave;nh trạng lệch pha n&agrave;y kh&oacute; c&oacute; thể sớm cải thiện khi loạt dự &aacute;n cao cấp, hạng sang tiếp tục đổ bộ thị trường. Mức gi&aacute; 100 triệu đồng một m2 hiện nay kh&ocirc;ng xa lạ với thị trường chung cư H&agrave; Nội như v&agrave;i năm trước. Thậm ch&iacute;, một số dự &aacute;n căn hộ cũng được chủ đầu tư thiết lập mức gi&aacute; đến mốc 200 triệu đồng một m2 - cao ngang ngửa biệt thự liền kề ở v&ugrave;ng ven.</p>

<p>Nhiều đơn vị nghi&ecirc;n cứu dự b&aacute;o nguồn chung cư H&agrave; Nội c&oacute; thể tăng mạnh trở lại từ năm sau. Trong hai năm tới, thị trường n&agrave;y c&oacute; thể đ&oacute;n gần 50.000 căn hộ mới, chủ yếu từ khu vực ph&iacute;a T&acirc;y v&agrave; Đ&ocirc;ng. Tuy nhi&ecirc;n, nh&agrave; b&igrave;nh d&acirc;n, nh&agrave; vừa t&uacute;i tiền vẫn sẽ thiếu vắng khi ph&acirc;n kh&uacute;c cao cấp vẫn c&oacute; thể duy tr&igrave; tỷ trọng khoảng 70% trong tổng nguồn cung mới.</p>', 
                'user_id' => 3, 
                'image' => '/userfiles/image/Danh%20m%E1%BB%A5c%20cha/BDS/bds.jpg', 
                'publish' => '2', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(),
            ],
            [
                'post_catalogue_children_id' => 1, 
                'post_catalogue_parent_id' => 7, 
                'post_name' => 'Hàng nghìn fan ôn kỷ niệm 30 năm truyện tranh Conan', 
                'post_excerpt' => '<p>H&agrave; NộiHơn 2.000 độc giả đến triển l&atilde;m &quot;30 năm đi c&ugrave;ng k&yacute; ức&quot; về bộ truyện &quot;Th&aacute;m tử lừng danh Conan&quot;.</p>', 
                'post_content' => '<p>Triển l&atilde;m đ&oacute;n lượng kh&aacute;ch lớn khi khai trương trong hai ng&agrave;y cuối tuần - 26 v&agrave; 27/10. Kh&aacute;ch tham quan phải tr&ecirc;n 12 tuổi, mua v&eacute; gi&aacute; từ 200.000 đồng đến 1.000.000 đồng. Mỗi lượt, ban tổ chức chỉ đ&oacute;n 15 độc giả để tr&aacute;nh chen ch&uacute;c, mang lại trải nghiệm tốt cho người xem.</p>

<p>Nhiều fan của bộ truyện ở độ tuổi trung ni&ecirc;n, dẫn theo con, ch&aacute;u. Nguyễn Hải H&agrave;, 43 tuổi, nh&acirc;n vi&ecirc;n văn ph&ograve;ng ở H&agrave; Nội, theo d&otilde;i bộ truyện từ năm 2000, khi mới xuất bản ở Việt Nam. Chị mua từ tập một đến tập 40, giữ g&igrave;n cẩn thận nhiều năm. Điều Hải H&agrave; th&iacute;ch ở&nbsp;<em>Conan</em>&nbsp;l&agrave; c&aacute;c t&igrave;nh tiết logic, l&ocirc;i cuốn v&agrave; đều c&oacute; kết th&uacute;c nh&acirc;n văn. Đến nay, chị đ&atilde; dừng đọc nhưng vẫn mua truyện cho con đang học cấp hai.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Độc giả xếp hàng, chờ vào triển lãm về Conan, sáng 27/10. Ảnh: Nhà xuất bản Kim Đồng" data-ll-status="loaded" data-src="https://i1-giaitri.vnecdn.net/2024/10/28/doc-gia-conan-9820-1730101026.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=GieMrrHa9RW2PzoUpMywZg" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-giaitri.vnecdn.net/2024/10/28/doc-gia-conan-9820-1730101026.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=GieMrrHa9RW2PzoUpMywZg" />
<figcaption itemprop="description">
<p>Độc giả xếp h&agrave;ng, chờ v&agrave;o triển l&atilde;m về Conan, s&aacute;ng 27/10. Ảnh:<em>&nbsp;Nh&agrave; xuất bản Kim Đồng</em></p>
</figcaption>
</figure>

<p>&quot;V&agrave;i năm trước, t&ocirc;i rất bực bội v&igrave; Conan m&atilde;i kh&ocirc;ng kết th&uacute;c. Nhưng t&aacute;c giả vẫn tiếp tục nghĩ ra những vụ &aacute;n mới, thu h&uacute;t độc giả mới, n&ecirc;n bộ truyện c&oacute; lẽ kh&ocirc;ng cần kết&quot;, Hải H&agrave; n&oacute;i.</p>

<p>Anh Thư, 22 tuổi, sinh vi&ecirc;n ở H&agrave; Nội, đọc&nbsp;<em>Conan</em>&nbsp;từ khi l&agrave; học sinh tiểu học. C&ocirc; từng sưu tập hơn 80 tập truyện, sau đ&oacute; b&aacute;n s&aacute;ch cũ để c&oacute; tiền mua c&aacute;c tập mới. Anh Thư th&iacute;ch n&eacute;t vẽ của t&aacute;c giả, sinh động v&agrave; ch&acirc;n thật. C&ocirc; th&iacute;ch th&aacute;m tử Hattori Heiji - bạn của Conan - bởi nh&acirc;n vật c&oacute; tư duy suy luận l&ocirc;i cuốn, th&ocirc;ng minh, tinh tế.</p>

<p>B&iacute;ch Ngọc, 26 tuổi, theo d&otilde;i bộ truyện khoảng 15 năm. &quot;T&ocirc;i vẫn mong chờ c&aacute;i kết n&ecirc;n đ&oacute;n đọc từng tập mới. T&ocirc;i th&iacute;ch mối t&igrave;nh của Sinichi v&agrave; Ran, cảm phục sự chờ đợi, tin tưởng m&agrave; họ d&agrave;nh cho nhau&quot;.</p>

<p>Nhiều độc giả cho biết hạnh ph&uacute;c v&igrave; vừa đủ tuổi xem triển l&atilde;m. Nh&oacute;m học sinh trường li&ecirc;n cấp Edison gồm Bảo Ngọc, Mộc Hương, L&ecirc; An, đều đọc Conan từ khi học cấp một. Họ biết đến bộ truyện qua bạn học, người th&acirc;n. C&aacute;c độc giả thiếu ni&ecirc;n đều c&oacute; t&acirc;m l&yacute; vừa sợ h&atilde;i vừa phấn kh&iacute;ch khi theo d&otilde;i c&aacute;c t&igrave;nh tiết.</p>

<p><strong>Sự kiện đưa độc giả ho&agrave;i niệm về những k&yacute; ức gắn với bộ truyện qua ba thập ni&ecirc;n.&nbsp;</strong>Nhiều kh&ocirc;ng gian trưng b&agrave;y hệ thống nh&acirc;n vật, sơ đồ về tổ chức &aacute;o đen, những t&ecirc;n tội phạm từng xuất hiện, c&aacute;c dụng cụ g&acirc;y &aacute;n, thể hiện sự đồ sộ, tỉ mỉ của series.</p>

<p>Trong căn ph&ograve;ng giới thiệu về t&aacute;c giả Gosho Aoyama, &ocirc;ng chia sẻ những bản thảo, b&uacute;t t&iacute;ch, tạo h&igrave;nh nh&acirc;n vật thời kỳ đầu. Trong một b&agrave;i phỏng vấn, Aoyama nhớ ban đầu, &ocirc;ng định vẽ một th&aacute;m tử xấu xa c&oacute; khả năng đọc k&yacute; ức của đồ vật bằng c&aacute;ch chạm v&agrave;o n&oacute;. Sau đ&oacute;, nh&agrave; xuất bản gợi &yacute; &ocirc;ng s&aacute;ng t&aacute;c truyện trinh th&aacute;m thực thụ. &Ocirc;ng nhớ lại l&uacute;c tiểu học, m&igrave;nh từng th&iacute;ch Holmes, v&agrave; sau đ&oacute; Conan ra đời.</p>

<p>Ban đầu, &ocirc;ng chỉ định viết truyện trong ba th&aacute;ng, cuối c&ugrave;ng k&eacute;o d&agrave;i đến 30 năm. &quot;T&ocirc;i c&ograve;n nghĩ truyện tranh nhiều chữ thế n&agrave;y ai th&egrave;m đọc, thế m&agrave; kh&ocirc;ng ngờ được h&acirc;m mộ đến vậy&quot;, Aoyama n&oacute;i.</p>

<p>20 năm đầu ti&ecirc;n, &ocirc;ng chỉ ngủ ba tiếng mỗi ng&agrave;y. 10 năm nay, t&aacute;c giả thảnh thơi hơn v&igrave; được nghỉ một th&aacute;ng sau mỗi m&ugrave;a truyện.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Độc giả tham quan góc trưng bày các hung khí được phục dựng. Ảnh: Châu Anh" data-ll-status="loaded" data-src="https://i1-giaitri.vnecdn.net/2024/10/28/trien-lam-connan-2-1730101015-3461-1730101027.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=p3yOoZ2ifshgb89c2NR82A" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-giaitri.vnecdn.net/2024/10/28/trien-lam-connan-2-1730101015-3461-1730101027.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=p3yOoZ2ifshgb89c2NR82A" />
<figcaption itemprop="description">
<p>Độc giả tham quan g&oacute;c trưng b&agrave;y c&aacute;c hung kh&iacute; được phục dựng. Ảnh:&nbsp;<em>Ch&acirc;u Anh</em></p>
</figcaption>
</figure>

<p>Ban tổ chức trưng b&agrave;y sơ đồ điểm lại c&aacute;c dấu mốc trong 30 năm bộ truyện ra đời. Th&aacute;ng 1/1994, series&nbsp;<em>Th&aacute;m tử lừng danh Conan</em>&nbsp;được đăng d&agrave;i kỳ tr&ecirc;n tạp ch&iacute; ở Nhật Bản, chuyển thể th&agrave;nh anime năm 1996. Th&aacute;ng 11/2004, bộ truyện chạm mốc 500 kỳ tr&ecirc;n tuần san&nbsp;<em>Shonen Sunday</em>. Năm 2007, bảo t&agrave;ng của t&aacute;c giả Gosho Aoyama được khai trương tại quận Tokahu, tỉnh Tottori. Năm 2013, tuyến đường sắt Jr San&#39;in được đặt t&ecirc;n th&acirc;n mật l&agrave; Ga Connan. Hai năm sau, s&acirc;n bay Tottori cũng được đặt theo t&ecirc;n nh&acirc;n vật.</p>

<p>Năm nay, dịp kỷ niệm 30 năm ph&aacute;t h&agrave;nh,&nbsp;<em>Th&aacute;m tử lừng danh Conan</em>&nbsp;đạt mốc 270 triệu bản tr&ecirc;n to&agrave;n thế giới.</p>

<p>Trước đ&oacute;, triển l&atilde;m&nbsp;<a data-itm-added="1" data-itm-source="#vn_source=Detail-GiaiTri_Sach_LangVan-4809254&amp;vn_campaign=Box-InternalLink&amp;vn_medium=Link-MoCua&amp;vn_term=Desktop&amp;vn_thumb=0" href="https://vnexpress.net/trien-lam-ve-tham-tu-conan-dau-tien-o-viet-nam-4764489.html" rel="dofollow">mở cửa</a>&nbsp;tại một trung t&acirc;m thương mại ở TP Thủ Đức, TP HCM, đ&aacute;nh dấu lần đầu ti&ecirc;n sự kiện được tổ chức ngo&agrave;i Nhật Bản. Địa điểm chia th&agrave;nh nhiều ph&ograve;ng theo chủ đề, để fan được h&ograve;a m&igrave;nh v&agrave;o thế giới trinh th&aacute;m c&ugrave;ng th&aacute;m tử nh&iacute;.</p>', 
                'user_id' => 3, 
                'image' => '/userfiles/image/Danh%20m%E1%BB%A5c%20cha/GiaTri/doc-gia-conan-9820-1730101026.jpg', 
                'publish' => '2', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(),
            ],
            [
                'post_catalogue_children_id' => 3, 
                'post_catalogue_parent_id' => 1, 
                'post_name' => 'Mức thu nhập của lao động Việt Nam tại các thị trường', 
                'post_excerpt' => '<p>Thu nhập h&agrave;ng th&aacute;ng của lao động Việt Nam tại H&agrave;n Quốc dao động 1.600-2.000 USD, trong khi thị trường truyền thống như Malaysia khoảng 400- 600 USD.</p>', 
                'post_content' => '<p><em>Hồ sơ di cư Việt Nam 2023</em>&nbsp;do Cục L&atilde;nh sự Bộ Ngoại giao c&ocirc;ng bố cuối th&aacute;ng 10 dẫn thống k&ecirc; mức thu nhập từ c&aacute;c thị trường trọng điểm lao động Việt Nam đang l&agrave;m việc.</p>

<p>Lao động l&agrave;m việc tại H&agrave;n Quốc cho thu nhập cao nhất 1.600-2.000 USD, kế đến l&agrave; Nhật Bản 1.200-1.500 USD; Đ&agrave;i Loan 800-1.200 USD, một số quốc gia ch&acirc;u &Acirc;u c&oacute; mức tương tự. Thị trường Trung Đ&ocirc;ng v&agrave; Malaysia ghi nhận mức lương thấp hơn, khoảng 600- 1.000 USD với lao động c&oacute; tay nghề v&agrave; 400-600 USD mỗi th&aacute;ng với lao động phổ th&ocirc;ng.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Lao động tham gia kỳ thi sát hạch theo Chương trình EPS đi làm việc tại Hàn Quốc, năm 2023. Ảnh: Ngọc Thành" data-ll-status="loaded" data-src="https://i1-vnexpress.vnecdn.net/2024/10/31/L1080012-JPG-1683521400-7511-1730369036.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=qocbi4VxZHK0IwNIAEJSoQ" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-vnexpress.vnecdn.net/2024/10/31/L1080012-JPG-1683521400-7511-1730369036.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=qocbi4VxZHK0IwNIAEJSoQ" />
<figcaption itemprop="description">
<p>Lao động tham gia kỳ thi s&aacute;t hạch theo Chương tr&igrave;nh EPS đi l&agrave;m việc tại H&agrave;n Quốc, năm 2023. Ảnh:&nbsp;<em>Ngọc Th&agrave;nh</em></p>
</figcaption>
</figure>

<p>Phần lớn thị trường tiếp nhận đều c&oacute; lương tối thiểu cao hơn nhiều so với trong nước. Năm 2022, hai thị trường đ&ocirc;ng lao động Việt l&agrave; Nhật Bản, H&agrave;n Quốc lương tối thiểu cao gấp 7-9 lần; tại Australia v&agrave; New Zealand gấp khoảng 15 lần. Trung Quốc, Malaysia, Th&aacute;i Lan ghi nhận lương tối thiểu cao hơn hẳn Việt Nam.</p>

<p>&quot;Chi ph&iacute; sinh hoạt đắt đỏ nhưng với mức lương tr&ecirc;n lao động vẫn c&oacute; thu nhập tốt hơn so với việc l&agrave;m trong nước&quot;, hồ sơ đ&aacute;nh gi&aacute;, th&ecirc;m rằng người đi c&ograve;n c&oacute; cơ hội bồi dưỡng tay nghề lẫn t&iacute;ch lũy kỹ năng trong m&ocirc;i trường l&agrave;m việc.</p>

<p>Hơn 650.000 lao động Việt Nam đang l&agrave;m việc tại hơn 40 quốc gia v&agrave; v&ugrave;ng l&atilde;nh thổ, mỗi năm gửi về 3,5- 4 tỷ USD kiều hối. Đ&agrave;i Loan, Nhật Bản, H&agrave;n Quốc vẫn l&agrave; ba thị trường trọng điểm. Nhật Bản 5 năm liền đứng đầu về tiếp nhận lao động Việt. Ngo&agrave;i thị trường truyền thống, Việt Nam đang mở rộng đưa người đi l&agrave;m việc tại Australia, New Zealand, Đức, Hungari.</p>

<p>T&iacute;nh theo nơi đi, Đồng bằng s&ocirc;ng Hồng với 7 tỉnh th&agrave;nh Hải Dương, Hưng Y&ecirc;n, Nam Định, H&agrave; Nội, Th&aacute;i B&igrave;nh, Ninh B&igrave;nh, Hải Ph&ograve;ng dẫn đầu cả nước với hơn 32.600 người. Theo sau l&agrave; Bắc Trung Bộ v&agrave; duy&ecirc;n hải miền Trung với 5 tỉnh Thanh H&oacute;a, Nghệ An, H&agrave; Tĩnh, Quảng B&igrave;nh, Quảng Trị hơn 25.500 người.</p>

<p>ngh&igrave;n người10 địa phương đ&ocirc;ng lao động đi l&agrave;m việc ngo&agrave;i nướcT&iacute;nh 11 th&aacute;ng năm 2023Số ngườiNghệ AnH&agrave; TĩnhThanh H&oacute;aHải DươngQuảng B&igrave;nhNam ĐịnhHải Ph&ograve;ngH&agrave; NộiHưng Y&ecirc;nTh&aacute;i B&igrave;nh02.557.51012.51517.52022.5Nguồn: Cục L&atilde;nh sự Bộ Ngoại giao</p>

<p>Theo Hồ sơ di cư, 80% lao động Việt Nam l&agrave;m việc ngo&agrave;i nước trong c&aacute;c ng&agrave;nh th&acirc;m dụng như sản xuất chế tạo như cơ kh&iacute;, may mặc, gi&agrave;y da, lắp r&aacute;p điện tử; tiếp đến l&agrave; x&acirc;y dựng, n&ocirc;ng nghiệp, thủy sản, dịch vụ gi&uacute;p việc gia đ&igrave;nh, chăm s&oacute;c người gi&agrave;, người bệnh. Một bộ phận lao động tr&igrave;nh độ cao như nh&agrave; quản l&yacute;, kỹ sư lựa chọn ở lại nước ngo&agrave;i l&agrave;m việc v&igrave; thu nhập cao, đ&atilde;i ngộ tốt, c&oacute; m&ocirc;i trường ph&aacute;t triển, g&acirc;y n&ecirc;n t&igrave;nh trạng &quot;chảy m&aacute;u chất x&aacute;m&quot;.</p>

<p>Lao động phổ th&ocirc;ng Việt Nam được đ&aacute;nh gi&aacute; l&agrave; chịu kh&oacute;, biết việc, nhưng tỷ lệ ở lại tr&aacute;i ph&eacute;p sau khi hết hợp đồng hoặc bỏ ra ngo&agrave;i l&agrave;m cao, khiến nhiều người trong nước mất cơ hội xuất ngoại. Một số nơi xảy ra t&igrave;nh trạng lao động Việt Nam bị x&acirc;m phạm quyền lợi như ngược đ&atilde;i, l&agrave;m việc qu&aacute; giờ, chủ sử dụng đối xử kh&ocirc;ng c&ocirc;ng bằng, điều kiện l&agrave;m việc chưa được bảo đảm.</p>

<p>&Ocirc;ng L&ecirc; Ho&agrave;ng H&agrave;, chuy&ecirc;n vi&ecirc;n Cục Quản l&yacute; lao động ngo&agrave;i nước, Bộ Lao động Thương binh v&agrave; X&atilde; hội, đ&aacute;nh gi&aacute; thế mạnh của Việt Nam vẫn l&agrave; lao động phổ th&ocirc;ng chưa qua đ&agrave;o tạo, song tại nhiều nước ph&aacute;t triển c&aacute;c c&ocirc;ng việc giản đơn được thay thế bằng robot, ứng dụng c&ocirc;ng nghệ. Ngoại ngữ vẫn l&agrave; r&agrave;o cản lớn với lao động Việt Nam ở nước ngo&agrave;i.</p>

<p>Những yếu tố tr&ecirc;n, theo &ocirc;ng H&agrave; cộng hưởng trở th&agrave;nh th&aacute;ch thức lớn n&ecirc;n việc bồi dưỡng tay nghề lẫn tập trung ngoại ngữ rất quan trọng để người lao động n&acirc;ng sức cạnh tranh, tăng cơ hội việc l&agrave;m sau khi về nước.</p>', 
                'user_id' => 3, 
                'image' => '/userfiles/image/Danh%20m%E1%BB%A5c%20cha/Th%E1%BB%9Di%20s%E1%BB%B1/aaa.jpg', 
                'publish' => '2', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(),
            ],
            [
                'post_catalogue_children_id' => 5, 
                'post_catalogue_parent_id' => 1, 
                'post_name' => 'Giá vé Metro Bến Thành - Suối Tiên thấp nhất 6.000 đồng mỗi lượt', 
                'post_excerpt' => '<p>TP HCM Kh&aacute;ch đi Metro số 1 (Bến Th&agrave;nh - Suối Ti&ecirc;n) dự kiến trả 6.000-20.000 đồng mỗi lượt, t&ugrave;y h&igrave;nh thức thanh to&aacute;n, qu&atilde;ng đường, thay đổi so với phương &aacute;n trước.</p>', 
                'post_content' => '<p>Th&ocirc;ng tin n&ecirc;u trong tờ tr&igrave;nh gi&aacute; v&eacute; sử dụng metro vừa được Sở Giao th&ocirc;ng Vận tải gửi UBND TP HCM xem x&eacute;t. Đ&acirc;y l&agrave; tuyến t&agrave;u điện đầu ti&ecirc;n ở th&agrave;nh phố, dự kiến khai th&aacute;c thương mại từ cuối năm nay, giai đoạn đầu ước t&iacute;nh mỗi ng&agrave;y phục vụ gần 40.000 kh&aacute;ch.</p>

<p>So với&nbsp;<a data-itm-added="1" data-itm-source="#vn_source=Detail-ThoiSu_GiaoThong-4812461&amp;vn_campaign=Box-InternalLink&amp;vn_medium=Link-KhungGiaDuThao&amp;vn_term=Desktop&amp;vn_thumb=0" href="https://vnexpress.net/de-xuat-ve-metro-ben-thanh-suoi-tien-12-000-18-000-moi-luot-4640207.html" rel="dofollow">khung gi&aacute; dự thảo</a>&nbsp;năm ngo&aacute;i, gi&aacute; v&eacute; đi Metro Bến Th&agrave;nh - Suối Ti&ecirc;n lần n&agrave;y c&oacute; một số thay đổi đối với loại v&eacute; lượt v&agrave; th&aacute;ng. Trong đ&oacute;, kh&aacute;ch đi v&eacute; lượt nếu d&ugrave;ng tiền mặt sẽ trả từ 7.000 đồng đến 20.000 đồng mỗi người, t&ugrave;y qu&atilde;ng đường. Nếu chọn thanh to&aacute;n kh&ocirc;ng d&ugrave;ng tiền mặt, gi&aacute; v&eacute; lượt sẽ giảm nhẹ, dao động từ 6.000 đồng đến 19.000 đồng.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Khách trải nghiệm trên tàu Metro số 1 khi vận hành thử nghiệm. Ảnh: Quỳnh Trần" data-ll-status="loaded" data-src="https://i1-vnexpress.vnecdn.net/2024/11/05/metro-9-1682505212-1730797240-4893-1730797372.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=Q1wuuqQyW15D4ALRN1NKrw" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-vnexpress.vnecdn.net/2024/11/05/metro-9-1682505212-1730797240-4893-1730797372.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=Q1wuuqQyW15D4ALRN1NKrw" />
<figcaption itemprop="description">
<p>Kh&aacute;ch trải nghiệm tr&ecirc;n t&agrave;u Metro số 1 khi vận h&agrave;nh thử nghiệm. Ảnh:&nbsp;<em>Quỳnh Trần</em></p>
</figcaption>
</figure>

<p>Đối với v&eacute; th&aacute;ng (kh&ocirc;ng giới hạn số lượt đi), &aacute;p dụng 300.000 đồng mỗi kh&aacute;ch, cao hơn 40.000 đồng so với phương &aacute;n trước. Ri&ecirc;ng học sinh, sinh vi&ecirc;n mua v&eacute; th&aacute;ng được giảm 50%, c&ograve;n 150.000 đồng/th&aacute;ng. Ngo&agrave;i c&aacute;c loại v&eacute; tr&ecirc;n, kh&aacute;ch c&oacute; thể mua v&eacute; một ng&agrave;y hoặc ba ng&agrave;y, lần lượt 40.000 đồng v&agrave; 90.000 đồng, tương đương mức gi&aacute; đề xuất trước đ&acirc;y.</p>

<p>Theo Sở Giao th&ocirc;ng Vận tải, phương &aacute;n gi&aacute; v&eacute; lần n&agrave;y được x&acirc;y dựng dựa tr&ecirc;n nguy&ecirc;n tắc về khả năng chi trả của phần lớn người d&acirc;n, so s&aacute;nh với gi&aacute; v&eacute; của Metro C&aacute;t Linh - H&agrave; Đ&ocirc;ng (H&agrave; Nội); bu&yacute;t; tăng khả năng cạnh tranh với xe c&aacute; nh&acirc;n nhằm thu h&uacute;t kh&aacute;ch đi metro... Th&agrave;nh phố dự kiến ph&aacute;t h&agrave;nh hơn 2 triệu thẻ đi Metro số 1 trong giai đoạn đầu.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Metro số 1 chạy thử từ ga Suối Tiên tới ga An Phú, đoạn qua nút giao Cát Lái. Ảnh: Thanh Tùng" data-ll-status="loaded" data-src="https://i1-vnexpress.vnecdn.net/2024/11/05/metro-16-6166-1730798310-17307-3822-9495-1730798648.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=8Q2MkCFwUH6TdXA53_xgaw" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-vnexpress.vnecdn.net/2024/11/05/metro-16-6166-1730798310-17307-3822-9495-1730798648.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=8Q2MkCFwUH6TdXA53_xgaw" />
<figcaption itemprop="description">
<p>Metro số 1 chạy thử từ ga Suối Ti&ecirc;n tới ga An Ph&uacute;, đoạn qua n&uacute;t giao C&aacute;t L&aacute;i. Ảnh:&nbsp;<em>Thanh T&ugrave;ng</em></p>
</figcaption>
</figure>

<p>Ngo&agrave;i phương &aacute;n gi&aacute; v&eacute;, trong 30 ng&agrave;y đầu khai th&aacute;c thương mại, kh&aacute;ch đi Metro Bến Th&agrave;nh - Suối Ti&ecirc;n c&ugrave;ng 17 tuyến bu&yacute;t kết nối sẽ được miễn v&eacute; nhằm khuyến kh&iacute;ch người d&acirc;n sử dụng tuyến t&agrave;u điện đầu ti&ecirc;n ở địa b&agrave;n. Ng&acirc;n s&aacute;ch th&agrave;nh phố dự kiến sẽ chi khoảng 33 tỷ đồng để thực hiện phương &aacute;n n&agrave;y.</p>

<p><a data-itm-added="1" data-itm-source="#vn_source=Detail-ThoiSu_GiaoThong-4812461&amp;vn_campaign=Box-InternalLink&amp;vn_medium=Link-MetroBenThanhSuoiTien&amp;vn_term=Desktop&amp;vn_thumb=0" href="https://vnexpress.net/bai-do-metro-lon-nhat-nuoc-o-sai-gon-4747644.html" rel="dofollow">Metro Bến Th&agrave;nh - Suối Ti&ecirc;n</a>&nbsp;c&oacute; tổng mức đầu tư hơn 43.700 tỷ đồng, d&agrave;i gần 20 km, kết nối trung t&acirc;m th&agrave;nh phố về cửa ng&otilde; ph&iacute;a Đ&ocirc;ng. To&agrave;n tuyến c&oacute; 11 ga tr&ecirc;n cao, 3 ga ngầm. Sau 12 năm khởi c&ocirc;ng, nhiều lần gia hạn ho&agrave;n th&agrave;nh, tuyến t&agrave;u điện n&agrave;y đang được đặt mục ti&ecirc;u khai th&aacute;c thương mại tuyến từ cuối năm nay.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Lộ trình tuyến Metro Bến Thành - Suối Tiên. Đồ họa: Khánh Hoàng" data-ll-status="loaded" data-src="https://i1-vnexpress.vnecdn.net/2024/11/05/map-metro-1-1684480794-2643-16-9902-3470-1730798648.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=aFWVYNqDZ4fWmo3pCxb6VQ" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-vnexpress.vnecdn.net/2024/11/05/map-metro-1-1684480794-2643-16-9902-3470-1730798648.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=aFWVYNqDZ4fWmo3pCxb6VQ" />
<figcaption itemprop="description">
<p>Lộ tr&igrave;nh tuyến Metro Bến Th&agrave;nh - Suối Ti&ecirc;n. Đồ họa:&nbsp;<em>Kh&aacute;nh Ho&agrave;ng</em></p>
</figcaption>
</figure>

<p>Hiện, tuyến metro đ&atilde; bước v&agrave;o giai đoạn chạy thử (trial run), m&ocirc; phỏng tương tự như c&aacute;ch vận h&agrave;nh thương mại, với thời gian mỗi chuyến t&agrave;u chạy gi&atilde;n c&aacute;ch khoảng 4 ph&uacute;t 30 gi&acirc;y. C&aacute;c nh&acirc;n vi&ecirc;n sẽ tham gia thử nghiệm 47 kịch bản kh&aacute;c nhau, bao gồm c&aacute;c t&igrave;nh huống khẩn cấp như ch&aacute;y, nổ, mất điện, ngập nước, mất t&iacute;n hiệu... Giai đoạn thử nghiệm n&agrave;y dự kiến kết th&uacute;c ng&agrave;y 17/11, song song với c&ocirc;ng t&aacute;c đ&aacute;nh gi&aacute; an to&agrave;n hệ thống, nghiệm thu để vận h&agrave;nh ch&iacute;nh thức.</p>', 
                'user_id' => 3, 
                'image' => '/userfiles/image/Danh%20m%E1%BB%A5c%20cha/Th%E1%BB%9Di%20s%E1%BB%B1/asa.jpg', 
                'publish' => '2', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(),
            ],
            [
                'post_catalogue_children_id' => 6, 
                'post_catalogue_parent_id' => 1, 
                'post_name' => 'Cần Thơ xây tường ngăn nước sông tràn vào bến Ninh Kiều', 
                'post_excerpt' => '<p>Đoạn gần một km bờ s&ocirc;ng Cần Thơ tại bến Ninh Kiều được x&acirc;y tường, đắp bao c&aacute;t cao 0,5-0,7 m ngăn triều cường tr&agrave;n v&agrave;o ảnh hưởng cuộc sống người d&acirc;n.</p>', 
                'post_content' => '<p>Trưa 1/11, &ocirc;ng Phan Thanh Điền, Trưởng Ph&ograve;ng Quản l&yacute; đ&ocirc; thị quận Ninh Kiều, TP Cần Thơ, cho biết địa phương vừa ho&agrave;n th&agrave;nh c&ocirc;ng tr&igrave;nh chắn nước để ứng ph&oacute; đợt triều cường mới đang diễn ra. Lần triều cường c&aacute;ch đ&acirc;y nửa th&aacute;ng, nước s&ocirc;ng tại khu vực d&acirc;ng cao khiến khu vực n&agrave;y<a data-itm-added="1" data-itm-source="#vn_source=Detail-ThoiSu_Mekong-4811082&amp;vn_campaign=Box-InternalLink&amp;vn_medium=Link-NgapSau&amp;vn_term=Desktop&amp;vn_thumb=0" href="https://vnexpress.net/ly-do-ben-ninh-kieu-o-can-tho-chim-trong-trieu-cuong-4807911.html" rel="dofollow">&nbsp;ngập s&acirc;u</a>.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Tường chắn được xây tại bến Ninh kiều để ngăn nước triều cường tràn vào. Ảnh: An Bình" data-ll-status="loaded" data-src="https://i1-vnexpress.vnecdn.net/2024/11/01/CHON-MOI-1-3388-1730443939.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=4yZcOQOX02N-yC0ogyjytA" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-vnexpress.vnecdn.net/2024/11/01/CHON-MOI-1-3388-1730443939.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=4yZcOQOX02N-yC0ogyjytA" />
<figcaption itemprop="description">
<p>Tường chắn được x&acirc;y tại bến Ninh kiều để ngăn nước triều cường tr&agrave;n v&agrave;o. Ảnh:&nbsp;<em>An B&igrave;nh</em></p>
</figcaption>
</figure>

<p>Với phương &aacute;n mới, đoạn gần 200 m tại khu vực bến du thuyền Cần Thơ đến tượng đ&agrave;i B&aacute;c Hồ, trước đ&acirc;y x&acirc;y tường chắn nước với độ cao khoảng 0,3 m nay x&acirc;y nối th&ecirc;m 0,5 m, n&acirc;ng tổng chiều cao l&ecirc;n 0,8 m. Đoạn khoảng 800 m c&ograve;n lại từ bến t&agrave;u kh&aacute;ch đến gi&aacute;p ranh nh&agrave; kh&aacute;ch số 2, t&ugrave;y vị tr&iacute; được đắp tường bằng bao c&aacute;t với độ cao 0,6-0,7 m. Sau khi ho&agrave;n th&agrave;nh, độ cao k&egrave; chắn nước của khu vực n&agrave;y n&acirc;ng l&ecirc;n 2,5 m, cao hơn đỉnh triều cường lịch sử năm 2022 (2,27 m).</p>

<p>&quot;C&ocirc;ng tr&igrave;nh mang t&iacute;nh chất chữa ch&aacute;y, với kinh ph&iacute; gần 100 triệu đồng từ nguồn x&atilde; hội h&oacute;a nhằm chắn triều cường từ s&ocirc;ng Hậu theo s&ocirc;ng Cần Thơ tr&agrave;n v&agrave;o khu vực bến Ninh Kiều&quot;, &ocirc;ng Điền n&oacute;i.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Đoạn tường chắn nước được làm bằng bao cát tại bến Ninh Kiều. Ảnh: An Bình" data-ll-status="loaded" data-src="https://i1-vnexpress.vnecdn.net/2024/11/01/CHON-SO-2-4934-1730443939.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=ckIql8KPwdNnTBXE7fP8Mg" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-vnexpress.vnecdn.net/2024/11/01/CHON-SO-2-4934-1730443939.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=ckIql8KPwdNnTBXE7fP8Mg" />
<figcaption itemprop="description">
<p>Đoạn tường chắn nước được l&agrave;m bằng bao c&aacute;t tại bến Ninh Kiều. Ảnh:&nbsp;<em>An B&igrave;nh</em></p>
</figcaption>
</figure>

<p>&Ocirc;ng Lệ Sỹ Vinh, Ph&oacute; gi&aacute;m đốc phụ tr&aacute;ch Đ&agrave;i Kh&iacute; tượng Thủy văn TP Cần Thơ, cho biết đợt triều cường mới diễn ra từ nay đến khoảng ng&agrave;y 5/11 với đỉnh dự b&aacute;o khoảng 2,05 m (vượt 5 cm so b&aacute;o động 3).</p>

<p>&quot;Tuy nhi&ecirc;n ảnh hưởng b&atilde;o Kong-rey vừa rồi tại Philippines qu&aacute; mạnh, mực nước biển d&acirc;ng l&ecirc;n cao đ&atilde; h&uacute;t lượng nước rất lớn ra khu vực đ&oacute;, khiến triều cường đợt n&agrave;y l&ecirc;n chậm v&agrave; kh&ocirc;ng lớn&quot;, &ocirc;ng Vinh n&oacute;i v&agrave; cho biết s&aacute;ng 1/11, đỉnh triều tr&ecirc;n s&ocirc;ng Hậu tại Cần Thơ l&agrave; 1,75 m (dưới 5 cm so b&aacute;o động 1); dự b&aacute;o mực nước cao nhất chiều nay cũng mức n&agrave;y.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject"><img alt="Đoạn tường chắn nước làm bằng bao cát có bậc tam cấp  để người dân và du khách ra vào công viên, lên xuống bến tàu du lịch. Ảnh: An Bình" data-ll-status="loaded" data-src="https://i1-vnexpress.vnecdn.net/2024/11/01/1-CHON-DEP-2041-1730443939.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=a8P0mhaoZfH368mR_Hescw" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-vnexpress.vnecdn.net/2024/11/01/1-CHON-DEP-2041-1730443939.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=a8P0mhaoZfH368mR_Hescw" />
<figcaption itemprop="description">
<p>Đoạn tường chắn nước l&agrave;m bằng bao c&aacute;t c&oacute; bậc &quot;tam cấp&quot; để người d&acirc;n v&agrave; du kh&aacute;ch ra v&agrave;o c&ocirc;ng vi&ecirc;n, l&ecirc;n xuống bến t&agrave;u du lịch. Ảnh:&nbsp;<em>An B&igrave;nh</em></p>
</figcaption>
</figure>

<p>Đợt triều cường từ 17-20/10 (rằm th&aacute;ng 9 &acirc;m lịch) vừa qua, mực nước tr&ecirc;n s&ocirc;ng Hậu tại Cần Thơ vượt b&aacute;o động 3 từ 11-20 cm. Nước từ s&ocirc;ng tr&agrave;n &agrave;o ạt qua đoạn bờ k&egrave; tại c&ocirc;ng vi&ecirc;n bến Ninh Kiều, cặp đường Hai B&agrave; Trưng v&agrave;o b&ecirc;n trong,&nbsp;<a data-itm-added="1" data-itm-source="#vn_source=Detail-ThoiSu_Mekong-4811082&amp;vn_campaign=Box-InternalLink&amp;vn_medium=Link-NgapGanMotMet&amp;vn_term=Desktop&amp;vn_thumb=0" href="https://vnexpress.net/ly-do-ben-ninh-kieu-o-can-tho-chim-trong-trieu-cuong-4807911.html" rel="dofollow">ngập gần một m&eacute;t</a>&nbsp;ở nhiều khu vực.</p>

<p>C&ocirc;ng vi&ecirc;n Ninh Kiều rộng gần 2,2 ha, nằm ở trung t&acirc;m th&agrave;nh phố, thu h&uacute;t nhiều du kh&aacute;ch. Khu vực n&agrave;y nằm trong v&ugrave;ng l&otilde;i trung t&acirc;m th&agrave;nh phố rộng 2.700 ha được bảo vệ bởi hệ thống c&ocirc;ng tr&igrave;nh ngh&igrave;n tỷ đồng như: bờ k&egrave; s&ocirc;ng Cần Thơ, cống, &acirc;u thuyền, trạm bơm ngăn triều... ho&agrave;n th&agrave;nh hồi th&aacute;ng 7.</p>

<p>Một l&atilde;nh đạo UBND quận Ninh Kiều cho biết khu vực c&ocirc;ng vi&ecirc;n ngập do nước từ s&ocirc;ng Hậu d&acirc;ng cao v&agrave; hệ thống k&egrave;, cống ở đ&acirc;y chưa được đầu tư đồng bộ. Quận đang xin th&agrave;nh phố cải tạo, n&acirc;ng đoạn k&egrave; l&ecirc;n khoảng 0,8-1 m để ngăn nước tr&agrave;n v&agrave;o bến. Việc n&agrave;y cũng gi&uacute;p đồng bộ hệ thống cống, &acirc;u thuyền chống ngập v&ugrave;ng l&otilde;i 2.700 ha tại khu vực trung t&acirc;m.</p>

<figure data-size="true" itemprop="associatedMedia image" itemscope="" itemtype="http://schema.org/ImageObject">
<p>&nbsp;</p>
<img alt="Khu vực bến Ninh Kiều được xây tường ngăn nước ở sông Cần Thơ tràn vào. Đồ họa: Đăng Hiếu" data-ll-status="loaded" data-src="https://i1-vnexpress.vnecdn.net/2024/11/01/462549505-1229071231476647-218-4760-8978-1730447604.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=dUTKEOkIABeUHmo0rWKCfg" intrinsicsize="680x0" itemprop="contentUrl" loading="lazy" src="https://i1-vnexpress.vnecdn.net/2024/11/01/462549505-1229071231476647-218-4760-8978-1730447604.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=dUTKEOkIABeUHmo0rWKCfg" />
<figcaption itemprop="description">
<p>Khu vực bến Ninh Kiều được x&acirc;y tường ngăn nước ở s&ocirc;ng Cần Thơ tr&agrave;n v&agrave;o. Đồ họa:&nbsp;<em>Đăng Hiếu</em></p>
</figcaption>
</figure>', 
                'user_id' => 3, 
                'image' => '/userfiles/image/Danh%20m%E1%BB%A5c%20cha/Th%E1%BB%9Di%20s%E1%BB%B1/saaa.jpg', 
                'publish' => '2', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(),
            ],
            [
                'post_catalogue_children_id' => 4, 
                'post_catalogue_parent_id' => 2, 
                'post_name' => 'Lựa chọn của người Mỹ', 
                'post_excerpt' => '<p>Bầu cử tổng thống Mỹ, th&uacute; vị thay, kh&ocirc;ng chỉ khiến nước Mỹ chia rẽ, m&agrave; người Việt Nam cũng chia phe tranh c&atilde;i.</p>', 
                'post_content' => '<p>Đ&ocirc;ng đảo c&ocirc;ng ch&uacute;ng quốc tế quan t&acirc;m tới diễn biến cuộc bầu cử Mỹ. T&ocirc;i v&agrave; c&aacute;c đồng nghiệp cũng thường thảo luận c&aacute;c vấn đề li&ecirc;n quan đến ch&iacute;nh s&aacute;ch đối nội v&agrave; đối ngoại trong cuộc đua v&agrave;o Nh&agrave; Trắng. Kh&ocirc;ng chỉ v&igrave; c&ocirc;ng việc chuy&ecirc;n m&ocirc;n, đ&acirc;y c&ograve;n l&agrave; mối quan t&acirc;m c&aacute; nh&acirc;n.</p>

<article>
<p>T&iacute;nh đến th&aacute;ng 9 năm 2024, c&oacute; hơn 186 triệu cử tri Mỹ đăng k&yacute; đi bỏ phiếu ở cấp bang. Cử tri Mỹ kh&ocirc;ng trực tiếp bỏ phiếu bầu Tổng thống. Số phiếu phổ th&ocirc;ng của cử tri được d&ugrave;ng để quyết định số lượng phiếu đại cử tri m&agrave; một ứng vi&ecirc;n gi&agrave;nh được, tổng cộng l&agrave; 538 phiếu, được ph&acirc;n chia tương ứng với số nghị sĩ của mỗi bang trong Quốc hội Mỹ. Trừ hai bang Maine v&agrave; Nebraska, 48 bang c&ograve;n lại quy định ứng vi&ecirc;n n&agrave;o gi&agrave;nh được nhiều phiếu phổ th&ocirc;ng nhất sẽ nhận được to&agrave;n bộ phiếu đại cử tri của bang đ&oacute;. Ứng vi&ecirc;n n&agrave;o gi&agrave;nh được tối thiểu 270 phiếu đại cử tri sẽ trở th&agrave;nh Tổng thống.</p>

<p>B&ecirc;n cạnh vị tr&iacute; Tổng thống, l&aacute; phiếu bầu cử năm nay c&ograve;n quyết định nhiều vấn đề quan trọng ở cấp bang v&agrave; li&ecirc;n bang, trong đ&oacute; c&oacute; những vấn đề nằm ngo&agrave;i tầm kiểm so&aacute;t của Tổng thống nhưng c&oacute; t&aacute;c động lớn đến chương tr&igrave;nh nghị sự của chủ nh&acirc;n Nh&agrave; Trắng bốn năm tiếp theo. Ở cấp bang, cử tri ở 41 bang sẽ bỏ phiếu để quyết định 159 vấn đề ch&iacute;nh s&aacute;ch, bao gồm việc sửa đổi hiến ph&aacute;p cấp bang. Trong đ&oacute;, mười bang sẽ bỏ phiếu để sửa đổi hiến ph&aacute;p li&ecirc;n quan đến quyền ph&aacute; thai, t&aacute;m bang bỏ phiếu để sửa đổi quy định bầu cử, ba bang bỏ phiếu để tăng lương tối thiểu v&agrave; ba bang bỏ phiếu để quyết định vấn đề nghỉ ốm được hưởng lương. Đ&acirc;y đều l&agrave; những vấn đề quan trọng của cử tri ở cấp bang m&agrave; li&ecirc;n bang kh&ocirc;ng thể can thiệp.</p>

<p>Ở cấp li&ecirc;n bang, đợt bầu cử n&agrave;y cũng đồng thời bầu 34 ghế ở Thượng viện v&agrave; to&agrave;n bộ 435 ghế ở Hạ viện. Hiện tại, đảng D&acirc;n chủ kiểm so&aacute;t Thượng viện, trong khi đảng Cộng h&ograve;a kiểm so&aacute;t Hạ viện, nhưng cả hai đảng chỉ duy tr&igrave; được một khoảng c&aacute;ch mong manh l&agrave; hai ghế. Đảng n&agrave;o thắng trong cuộc bầu cử n&agrave;y cũng sẽ t&aacute;c động lớn tới quyền lực v&agrave; th&agrave;nh tựu của Tổng thống, v&igrave; cả hai viện đều c&oacute; khả năng th&uacute;c đẩy lẫn ngăn chặn chương tr&igrave;nh nghị sự của chủ nh&acirc;n Nh&agrave; Trắng.</p>

<p>Những vấn đề nội địa, đặc biệt l&agrave; kinh tế, được cử tri quan t&acirc;m nhất. Một cuộc khảo s&aacute;t của Pew Research Center v&agrave;o th&aacute;ng 9/2024 cho biết ba vấn đề m&agrave; người ủng hộ Trump v&agrave; Harris quan t&acirc;m nhất l&agrave; kinh tế, y tế v&agrave; việc bổ nhiệm thẩm ph&aacute;n T&ograve;a &aacute;n Tối cao. Li&ecirc;n quan đến đối ngoại, cử tri Mỹ ch&uacute; &yacute; đến vấn đề nhập cư v&agrave; biến đổi kh&iacute; hậu, vốn đều c&oacute; t&aacute;c động mạnh đến kinh tế v&agrave; việc l&agrave;m ở Mỹ. Tương tự, những quyết định đối ngoại c&oacute; t&aacute;c động đến d&ograve;ng chảy thương mại v&agrave; đầu tư, như c&aacute;c thỏa thuận thương mại, quan hệ chiến lược, cũng l&agrave; một mối quan t&acirc;m của người Mỹ.</p>

<p>N&oacute;i như vậy nghĩa l&agrave; cả hai ứng vi&ecirc;n, cho d&ugrave; c&oacute; lập trường đối ngoại rất kh&aacute;c nhau, cũng đều hướng đến việc d&ugrave;ng ch&iacute;nh s&aacute;ch đối ngoại để th&uacute;c đẩy c&aacute;c mục ti&ecirc;u đối nội, đặc biệt l&agrave; về kinh tế. Ch&iacute;nh s&aacute;ch đối ngoại của ch&iacute;nh quyền Trump ở nhiệm kỳ đầu được nhiều chuy&ecirc;n gia m&ocirc; tả l&agrave; &quot;kh&oacute; đo&aacute;n&rsquo; v&agrave; &quot;nặng t&iacute;nh giao dịch&quot;. Kh&oacute; đo&aacute;n l&agrave; ở chỗ Trump thường xuy&ecirc;n c&oacute; những th&ocirc;ng điệp lẫn h&agrave;nh động thiếu nhất qu&aacute;n với cả đồng minh lẫn đối thủ, kh&ocirc;ng tu&acirc;n theo những quy ước ngoại giao th&ocirc;ng thường.</p>

<p>T&iacute;nh giao dịch thể hiện ở chỗ c&aacute;c quan hệ kinh tế đối với Trump chỉ đơn giản l&agrave; vấn đề thặng dư hay th&acirc;m hụt. V&agrave; c&aacute;ch ch&iacute;nh quyền Trump d&ugrave;ng để giải quyết vấn đề n&agrave;y l&agrave; &aacute;p thuế quan kh&ocirc;ng ph&acirc;n biệt đối tượng v&agrave; loại h&agrave;ng h&oacute;a, với lập luận l&agrave; thuế quan vừa gi&uacute;p hạn chế nhập khẩu vừa gi&uacute;p tăng ng&acirc;n s&aacute;ch.</p>

<p>C&aacute;c chuy&ecirc;n gia kinh tế, bao gồm c&aacute;c kinh tế gia đoạt giải Nobel, kh&ocirc;ng đồng &yacute; với lập luận đơn giản đ&oacute;. Nhưng ch&iacute;nh quyền Trump sẽ tiếp tục chủ nghĩa bảo hộ của nhiệm kỳ đầu bằng c&aacute;ch tiếp tục những biện ph&aacute;p cứng rắn như mức thuế quan chung, đơn phương l&ecirc;n đến 20% cho mọi loại h&agrave;ng h&oacute;a nhập khẩu v&agrave;o Mỹ, kể cả h&agrave;ng h&oacute;a Việt Nam. Ch&iacute;nh quyền Trump cũng c&oacute; thể mở lại những cuộc điều tra căn cứ theo Mục 301 của Luật Thương mại Mỹ 1974 đối với mặt h&agrave;ng gỗ v&agrave; việc định gi&aacute; tiền tệ của Việt Nam, nhằm giải quyết vấn đề th&acirc;m hụt thương mại Mỹ-Việt Nam (l&ecirc;n đến 114 tỷ USD năm 2022).</p>

<p>Trong quan hệ ngoại giao, ch&iacute;nh quyền Trump nhiệm kỳ đầu cũng xem quan hệ với c&aacute;c nước đồng minh v&agrave; NATO l&agrave; quan hệ dịch vụ, trả tiền để được hưởng. Người ủng hộ Trump cho rằng phong c&aacute;ch ngoại giao của Trump mang lại hiệu quả, nhưng thực tế l&agrave; quan hệ của Mỹ với c&aacute;c nước đồng minh v&agrave; đối t&aacute;c chiến lược gặp nhiều thử th&aacute;ch v&agrave; sẽ tiếp tục gặp kh&ocirc;ng &iacute;t th&aacute;ch thức nếu Trump t&aacute;i đắc cử.</p>

<p>Tuy chưa n&ecirc;u r&otilde; ch&iacute;nh s&aacute;ch đối với Đ&ocirc;ng Nam &Aacute;, ch&iacute;nh quyền Harris nhiều khả năng vẫn sẽ tiếp tục ch&iacute;nh s&aacute;ch đối ngoại như ch&iacute;nh quyền Biden. Về mặt thương mại, thuế quan sẽ tiếp tục được &aacute;p dụng linh hoạt t&ugrave;y ng&agrave;nh, t&ugrave;y mặt h&agrave;ng, kết hợp với ch&iacute;nh s&aacute;ch tăng cường năng lực nội địa v&agrave; hợp t&aacute;c đa phương. Harris nhiều khả năng sẽ tiếp tục ho&agrave;n thiện Khu&ocirc;n khổ Kinh tế Ấn Độ Dương-Th&aacute;i B&igrave;nh Dương (IPEF) m&agrave; Việt Nam l&agrave; một th&agrave;nh vi&ecirc;n. Khu&ocirc;n khổ n&agrave;y hướng đến việc tăng cường thương mại điện tử, củng cố c&aacute;c chuỗi cung ứng v&agrave; ph&aacute;t triển năng lượng sạch.</p>

<p>Về mặt ngoại giao, Harris sẽ tiếp tục th&uacute;c đẩy c&aacute;c cơ chế song phương v&agrave; đa phương, tăng cường hợp t&aacute;c với mạng lưới đồng minh, đồng thời cũng mở rộng quan hệ với c&aacute;c đối t&aacute;c chiến lược như ASEAN. C&oacute; thể n&oacute;i, ch&iacute;nh s&aacute;ch đối ngoại của Harris hướng đến sự ổn định l&acirc;u d&agrave;i, do đ&oacute; sẽ tương đối nhất qu&aacute;n v&agrave; kh&ocirc;ng c&oacute; nhiều yếu tố &quot;g&acirc;y sốc&quot;.</p>

<p>Tuy c&oacute; nhiều kh&aacute;c biệt, điểm chung li&ecirc;n quan đến Việt Nam l&agrave; cả hai ứng vi&ecirc;n đều nhận thức được tầm quan trọng chiến lược ng&agrave;y c&agrave;ng lớn của Việt Nam trong khu vực. Việc tăng cường quan hệ với Việt Nam mang lại lợi &iacute;ch song phương, được cả lưỡng đảng ở Mỹ ủng hộ, dẫn đến việc n&acirc;ng cấp l&ecirc;n quan hệ song phương l&ecirc;n th&agrave;nh Đối t&aacute;c chiến lược to&agrave;n diện năm 2023. Do đ&oacute; ai l&agrave; tổng thống cũng sẽ kh&oacute; c&oacute; thể g&acirc;y phương hại lớn đến mối quan hệ chiến lược n&agrave;y.</p>

<p>C&oacute; thể ch&iacute;nh quyền Trump sẽ khiến Việt Nam gặp nhiều thử th&aacute;ch hơn. Nhưng Việt Nam ho&agrave;n to&agrave;n c&oacute; thể biến thử th&aacute;ch th&agrave;nh cơ hội. Với một ch&iacute;nh s&aacute;ch đối ngoại đa dạng h&oacute;a, đa phương h&oacute;a, Việt Nam c&oacute; đủ kinh nghiệm v&agrave; năng lực để vượt qua th&aacute;ch thức v&agrave; tận dụng thời cơ. Một nghi&ecirc;n cứu cho thấy trong giai đoạn 2017-2020, Việt Nam vẫn l&agrave; một điểm s&aacute;ng trong bối cảnh Mỹ tăng cường bảo hộ thương mại, với sản lượng xuất khẩu c&aacute;c sản phẩm bị &aacute;p thuế quan tăng đến 40%.</p>

<p>Cuộc bầu cử tổng thống Mỹ, th&uacute; vị thay, kh&ocirc;ng chỉ khiến nước Mỹ chia rẽ, m&agrave; người d&acirc;n Việt Nam cũng chia phe, tranh c&atilde;i, ủng hộ với những lập luận v&agrave; g&oacute;c nh&igrave;n ri&ecirc;ng. Nhưng rốt cuộc, đ&acirc;y l&agrave; lựa chọn của người Mỹ. Cho d&ugrave; ai trở th&agrave;nh chủ nh&acirc;n của Nh&agrave; Trắng, Việt Nam cũng vẫn duy tr&igrave; được đ&agrave; ph&aacute;t triển.</p>
</article>', 
                'user_id' => 3, 
                'image' => '/userfiles/image/Danh%20m%E1%BB%A5c%20cha/Th%E1%BB%9Di%20s%E1%BB%B1/thumb-1280x720-241.jpg', 
                'publish' => '2', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
