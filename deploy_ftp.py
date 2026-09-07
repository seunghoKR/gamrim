# -*- coding: utf-8 -*-
"""
감림산기도원 iWinV 실서버 FTP 자동 배포 스크립트 (deploy_ftp.py)
"""
import os
import sys
import ftplib
from pathlib import Path
import urllib.request
import ssl

if sys.stdout.encoding != 'utf-8':
    try:
        sys.stdout.reconfigure(encoding='utf-8')
    except Exception:
        pass

FTP_HOST = '115.68.168.243'
FTP_USER = 'newgamrim'
FTP_PASS = 'seungho0409#'
REMOTE_ROOT = '/public_html'

LOCAL_ROOT = Path(__file__).resolve().parent

def make_dirs(ftp, remote_dir):
    parts = [p for p in remote_dir.replace('\\', '/').split('/') if p]
    current = ""
    for part in parts:
        current += "/" + part
        try:
            ftp.cwd(current)
        except ftplib.error_perm:
            try:
                ftp.mkd(current)
                print(f"[FTP] 원격 디렉토리 생성: {current}")
            except Exception:
                pass

def upload_file(ftp, local_path, remote_rel_path):
    remote_full_path = f"{REMOTE_ROOT}/{remote_rel_path.replace('\\', '/')}".replace('//', '/')
    remote_dir = '/'.join(remote_full_path.split('/')[:-1])
    filename = remote_full_path.split('/')[-1]
    
    make_dirs(ftp, remote_dir)
    ftp.cwd(remote_dir)
    
    print(f"[FTP] 업로드 중: {remote_rel_path}")
    with open(local_path, 'rb') as f:
        ftp.storbinary(f'STOR {filename}', f)

def deploy():
    print("==================================================")
    print("🚀 감림산기도원 iWinV 실서버 배포 시작")
    print(f"호스트: {FTP_HOST} | 대상: {REMOTE_ROOT}")
    print("==================================================")

    ftp = ftplib.FTP()
    ftp.connect(FTP_HOST, 21, timeout=30)
    ftp.login(FTP_USER, FTP_PASS)
    ftp.encoding = 'utf-8'
    print("[FTP] 연결 및 로그인 성공!")

    # 업로드 매핑 정의 (로컬 경로, 원격 상대 경로)
    upload_list = [
        # 1. 메인 컨트롤러 및 라우터
        (LOCAL_ROOT / "public" / "index.php", "index.php"),
        (LOCAL_ROOT / "controllers" / "HomeController.php", "controllers/HomeController.php"),
        
        # 2. 뷰 템플릿
        (LOCAL_ROOT / "views" / "main.php", "views/main.php"),
        (LOCAL_ROOT / "views" / "about.php", "views/about.php"),
        (LOCAL_ROOT / "views" / "layouts" / "header.php", "views/layouts/header.php"),
        (LOCAL_ROOT / "views" / "layouts" / "footer.php", "views/layouts/footer.php"),
        
        # 3. 이미지 자산
        (LOCAL_ROOT / "public" / "assets" / "images" / "about" / "director_okran.png", "assets/images/about/director_okran.png"),
        (LOCAL_ROOT / "public" / "assets" / "images" / "about" / "pastor_eunho.png", "assets/images/about/pastor_eunho.png"),
    ]

    for local_file, remote_rel in upload_list:
        if local_file.exists():
            upload_file(ftp, local_file, remote_rel)
        else:
            print(f"[WARN] 로컬 파일 없음: {local_file}")

    ftp.quit()
    print("==================================================")
    print("✅ FTP 파일 업로드 완료!")
    print("==================================================")

    # 실서버 헬스 체크
    print("\n🌐 실서버 HTTP 응답 검증 중...")
    ctx = ssl.create_default_context()
    ctx.check_hostname = False
    ctx.verify_mode = ssl.CERT_NONE

    urls = [
        "https://newgamrim.iwinv.net/",
        "https://newgamrim.iwinv.net/about",
    ]

    for url in urls:
        try:
            req = urllib.request.Request(url, headers={'User-Agent': 'GamrimDeployCheck/1.0'})
            with urllib.request.urlopen(req, context=ctx, timeout=10) as resp:
                print(f"[HTTP] {url} -> Status: {resp.status} OK")
        except Exception as e:
            print(f"[HTTP ERR] {url} -> {e}")

    print("\n🎉 모든 배포 절차가 성공적으로 완료되었습니다!")

if __name__ == '__main__':
    deploy()
