<?php
/*
	@���ݿ�����෽��
	@���ܣ��������ݿ��׼ģʽ
	@�����ˣ�����
	@����ʱ�䣺2013-11-19
*/

abstract class db{
	abstract protected function databaseLink();//���ݿ����ӷ���
	abstract protected function query($sql);//��ѯ����
	abstract protected function version();//�������ݰ汾��Ϣ
	abstract protected function free();//�ͷ����ݿ��ڴ�
	abstract protected function close();//�ر����ݿ�����
	abstract public function __destruct();//����ر����ݿ����ӵ���������
}
?>